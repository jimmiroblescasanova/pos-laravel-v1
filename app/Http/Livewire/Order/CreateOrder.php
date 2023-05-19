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

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->customerName = $this->order->customer;
        $this->discount = $this->order->discount;
        $this->paymentMethod = $this->order->payment_method;
    }

    public function addProduct(Product $selectedProduct)
    {
        if ($this->order->items->contains('product_id', $selectedProduct->id)) {
            notyf()
                ->ripple(true)
                ->duration(1500)
                ->addWarning('El producto ya esta en el carrito.');

            return false;
        }

        $this->order->items()->create([
            'product_id' => $selectedProduct->id,
            'price' => $selectedProduct->price,
        ]);

        $this->order->update([
            'total' => $this->order->total + $selectedProduct->price,
        ]);

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addInfo('Producto agregado');
    }

    public function removeProduct(OrderItem $orderItem)
    {
        $total = 0;
        $orderItem->forceDelete();

        foreach ($this->order->items()->get() as $orderItem) {
            $total += $orderItem->price * $orderItem->quantity;
        }

        $this->order->total = $total;
        if (($total - $this->order->discount) < 0) {
            $this->order->discount = 0;
            $this->discount = 0;
        }
        $this->order->save();

        notyf()
            ->ripple(true)
            ->duration(1500)
            ->addInfo('Producto eliminado');
    }

    public function increaseQuantity(OrderItem $orderItem)
    {
        if ($orderItem->product->inventory > $orderItem->quantity) {
            $orderItem->update([
                'quantity' => $orderItem->quantity + 1,
            ]);

            $this->order->update([
                'total' => $this->order->total + $orderItem->product->price,
            ]);
        }
    }

    public function decreaseQuantity(OrderItem $orderItem)
    {
        if ($orderItem->quantity > 1) {
            $orderItem->update([
                'quantity' => $orderItem->quantity - 1,
            ]);

            $this->order->update([
                'total' => $this->order->total - $orderItem->product->price,
            ]);
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
        $grandTotal = $this->order->total + $this->order->discount;

        if (($grandTotal - $value) < 0) {
            $this->discount = $this->order->discount;

            notyf()
                ->ripple(true)
                ->duration(1500)
                ->addError('Descuento excede el total');
            
            return false;
        }

        $this->order->update([
            'discount' => $value,
            'total' => $grandTotal - $value,
        ]);

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

            $item->product()->update([
                'inventory'     => $inventory,
                'total_sales'   => $item->product->total_sales + $item->quantity,
            ]);

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
