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

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->tax = $this->order->tax > 0 ?? true;
        $this->customerName = $this->order->customer;
        $this->discount = $this->order->discount;
        $this->paymentMethod = $this->order->payment_method;
    }

    public function updatedTax()
    {
        if ($this->tax == true) {
            // obtenemos el total
            $total = $this->order->total;
            // actualizamos el impuesto
            $this->order->update([
                'tax' => ($total * 1.16) - $total,
            ]);
        } else {
            // si es negativo, el impuesto es 0
            $this->order->update([
                'tax' => 0,
            ]);
        }
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
        $this->order->update([
            'total' => $this->order->total + $selectedProduct->price,
        ]);
        // actualizamos el impuesto
        $this->updatedTax();

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addInfo('Producto agregado');
    }

    public function removeProduct(OrderItem $orderItem)
    {
        // variable para almacenar el nuevo total de la orden
        $total = 0;
        // eliminamos el producto del carrito
        $orderItem->forceDelete();
        // loop para obtener el nuevo total de la orden
        foreach ($this->order->items()->get() as $orderItem) {
            $total += $orderItem->price * $orderItem->quantity;
        }
        // asignamos el nuevo total a la bd
        $this->order->total = $total;
        // si el nuevo total es menor al descuento, lo reseteamos
        if (($total - $this->order->discount) < 0) {
            $this->order->discount = 0;
            $this->discount = 0;
        }
        $this->order->save();
        // actualizamos el impuesto
        $this->updatedTax();

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addInfo('Producto eliminado');
    }

    public function increaseQuantity(OrderItem $orderItem)
    {
        // primero se valia que no exceda el inventario 
        if ($orderItem->product->inventory > $orderItem->quantity) {
            // se actualiza la cantidad de producto
            $orderItem->update([
                'quantity' => $orderItem->quantity + 1,
            ]);
            // actualizamos el total de la orden
            $this->order->update([
                'total' => $this->order->total + $orderItem->product->price,
            ]);
            // volvemos a calcular el impuesto
            $this->updatedTax();
        }
    }

    public function decreaseQuantity(OrderItem $orderItem)
    {
        // se valida que la cantidad no sea negativa
        if ($orderItem->quantity > 1) {
            // actualizamos la cantidad de producto
            $orderItem->update([
                'quantity' => $orderItem->quantity - 1,
            ]);
            // actualizamos el importe total de la orden
            $this->order->update([
                'total' => $this->order->total - $orderItem->product->price,
            ]);
            // volvemos a calcular el impuesto
            $this->updatedTax();
        }
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
        // se calcula el total con descuento
        $grandTotal = $this->order->total + $this->order->discount;
        // validamos si el descuento a aplicar es mayor
        // al gran total, o sea, negativo
        if (($grandTotal - $value) < 0) {
            // regresamos la variable al importe de la tabla
            $this->discount = $this->order->discount;

            notyf()
                ->ripple(true)
                ->duration(1500)
                ->addError('Descuento excede el total');
            
            return false;
        }
        // se actualiza el descuento del total de la orden
        $this->order->update([
            'discount' => $value,
            'total' => $grandTotal - $value,
        ]);
        // calculamos de nuevo el impuesto
        $this->updatedTax();

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
            'closed' => true,
        ]);

        return redirect()->route('ticket.print', $this->order);
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
}
