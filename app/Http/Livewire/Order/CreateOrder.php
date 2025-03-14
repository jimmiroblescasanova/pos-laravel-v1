<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use App\Jobs\SoldOutProduct;

class CreateOrder extends Component
{
    public $order;
    public $search = '';
    public $customerName;
    public $discount;
    public $paymentMethod;
    public $itemsCount = 0;
    public $tax = false;
    // variables para el modal
    public $manualItemSelected = null;
    public $manualQuantity = 0;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->tax = settings()->get('always_apply_tax') == true ?: false;
        $this->customerName = $this->order->customer;
        $this->discount = $this->order->discount;
        $this->paymentMethod = $this->order->payment_method;
    }

    public function addProduct(Product $selectedProduct)
    {
        // validamos el producto a agregar al carrito
        // si ya existe, avisamos y cancelamos
        if ($this->order->items->contains('product_id', $selectedProduct->id)) {
            notyf()
                ->ripple(true)
                ->duration(1500)
                ->addWarning('El producto ya esta en el carrito.');

            return false;
        }
        // se agrega el producto al carrito
        $this->order->items()->create([
            'product_id' => $selectedProduct->id,
            'price' => $selectedProduct->price,
        ]);
        // actualizamos el total de la orden
        $this->recalculateOrderAmounts($this->order);

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addInfo('Producto agregado');
    }

    public function removeProduct(OrderItem $orderItem)
    {
        // eliminamos el producto del carrito
        $orderItem->forceDelete();
        // loop para obtener el nuevo total de la orden
       $total = $this->order->items()->get()->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        // si el nuevo total es menor al descuento, lo reseteamos
        if (($total - $this->order->discount) < 0) {
            $this->order->discount = 0;
            $this->discount = 0;
        }
        $this->order->save();

        $this->recalculateOrderAmounts($this->order);

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addInfo('Producto eliminado');
    }

    public function increaseQuantity(OrderItem $orderItem): void
    {
        if (!$this->validateInventory($orderItem->product->inventory, $orderItem->quantity)) {
            return;
        }

        $orderItem->increment('quantity');

        $this->recalculateOrderAmounts($this->order);
    }

    public function decreaseQuantity(OrderItem $orderItem): void
    {
        // se valida que la cantidad no sea negativa
        if ($orderItem->quantity > 1) {
            $orderItem->decrement('quantity');

            $this->recalculateOrderAmounts($this->order);
        }
    }

    public function showEditQuantityModal(OrderItem $orderItem)
    {
        $this->manualItemSelected = $orderItem;
        $this->emit('show-modal', $orderItem->quantity);
    }

    public function setManualQuantity()
    {
        // validamos el inventario antes de incrementar
        if (!$this->validateInventory($this->manualItemSelected->product->inventory, $this->manualQuantity)) {
            return;
        }
        // actualizamos la cantidad de producto
        $this->manualItemSelected->update([
            'quantity' => $this->manualQuantity,
        ]);
        // actualizamos el total de la orden
        $this->recalculateOrderAmounts($this->order);
        // reseteamos las variables
        $this->manualItemSelected = null;
        $this->manualQuantity = 0;
        // cerramos el modal
        $this->emit('close-modal');
        // mostramos la notificacion
        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addSuccess('Cantidad actualizada');
    }

    public function updatedCustomerName($value)
    {
        $this->order->update([
            'customer' => $value,
        ]);

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addInfo('Cliente actualizado');
    }

    public function updatedDiscount($value)
    {
        $value = ($value === null || $value === '') ? 0 : $value;
        // se calcula el total con descuento
        $grandTotal = $this->order->total + $this->order->discount;
        // validamos si el descuento a aplicar es mayor
        // al gran total, o sea, negativo
        if (($grandTotal - $value) < 0) {
            // regresamos el descuento anterior al importe de la tabla
            $this->discount = $this->order->discount;

            notyf()
                ->ripple(true)
                ->duration(1500)
                ->addError('Descuento excede el total');
            
            return false;
        }
        $this->discount = $value;
        // se actualiza el descuento del total de la orden
        $this->order->update([
            'discount' => $value,
        ]);
        $this->recalculateOrderAmounts($this->order);

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addSuccess('Descuento actualizado');
        
    }

    public function updatedPaymentMethod($val)
    {
        $this->order->update(
            [
                'payment_method' => $val
            ]
        );

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addSuccess('Pago actualizado');
    }

    public function updatedTax($value): void
    {
        $this->recalculateOrderAmounts($this->order);
    }

    public function closeOrder()
    {
        // Descontar el inventario y sumar la venta
        foreach ($this->order->items as $item) {
            $inventory = $item->product->inventory - $item->quantity;
            // actualizamos la bd con el nuevo inventario y total de ventas
            $item->product()->update([
                'inventory'     => $inventory,
                'total_sales'   => $item->product->total_sales + $item->quantity,
            ]);
            // si el nuevo inventario es 0, enviamos notificacion de sold out
            if ($inventory == 0) {
                SoldOutProduct::dispatch($item->product->barcode);
            }
        }

        // Terminar y cerrar orden 
        $this->order->update([
            'folio' => Order::getNextFolio(),
            'closed' => true,
        ]);

        return redirect()->route('orders.print', $this->order);
    }

    public function render()
    {
        $this->itemsCount = $this->order->items()->count();

        $products = Product::query()
            ->search($this->search)
            ->where([
                ['inventory', '>', 0],
                ['active', 1],
            ])
            ->orderBy('total_sales', 'desc')
            ->take(15)
            ->get();

        return view('livewire.order.create-order', [
            'products' => $products,
            'orderItems' => $this->order->items()->get(),
        ]);
    }

    /**
     * Validates if there is enough inventory for the requested quantity
     *
     * @param int $inventory Current available inventory quantity
     * @param int $requestedQuantity Quantity being requested
     * @return bool Returns true if there is enough inventory, false otherwise
     * 
     * This method checks if the current inventory can satisfy the requested quantity.
     * If validation fails, it shows an error notification to the user.
     */
    private function validateInventory($inventory, $requestedQuantity): bool
    {
        if ($inventory < ($requestedQuantity + 1)) {
            notyf()
                ->ripple(true)
                ->duration(1500)
                ->addError('No hay suficiente inventario. Disponible: ' . $inventory);

            return false;
        }

        return true;
    }
    
    /**
     * Calculates the tax amount for a given total.
     * Uses a fixed tax rate of 16% (1.16).
     *
     */
    private function calculateTax($total)
    {
        $tax = ($total * 1.16) - $total;
        return round($tax, 2);
    }

    /**
     * Recalculates the total amount and tax for a given order
     *
     * This method performs the following calculations:
     * 1. Sums up the total by multiplying price * quantity for each order item
     * 2. Applies any existing discount to the total
     * 3. Calculates tax if applicable
     *
     * @param \App\Models\Order $order The order instance to recalculate amounts for
     * @return void
     */
    protected function recalculateOrderAmounts(Order $order)
    {
        $total = $order->items()->get()->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $order->update([
            'total' => $total - $order->discount,
            'tax' => $this->tax ? $this->calculateTax($total - $order->discount) : 0,
        ]);
    }
}
