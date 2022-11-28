<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;

class CreateOrder extends Component
{
    public $order;
    public $search = '';
    public $customerName;
    public $itemsCount = 0;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->customerName = $this->order->customer;
    }

    public function addProduct(Product $selectedProduct)
    {
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
        $orderItem->delete();

        foreach ($this->order->items()->get() as $orderItem) {
            $total += $orderItem->price * $orderItem->quantity;
        }

        $this->order->total = $total;
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

    public function closeOrder()
    {
        // Descontar el inventario y sumar la venta
        foreach ($this->order->items as $item) {
            $item->product()->update([
                'inventory'     => $item->product->inventory - $item->quantity,
                'total_sales'   => $item->product->total_sales + $item->quantity,
            ]);
        }

        // Terminar y cerrar orden 
        $this->order->update([
            'closed' => true,
        ]);

        return redirect()->route('home');
    }

    public function render()
    {
        $this->itemsCount = $this->order->items()->count();

        $products = Product::query()
            ->searchProduct($this->search)
            ->where('active', 1)
            ->orderBy('total_sales', 'desc')
            ->get();

        return view('livewire.order.create-order', [
            'products' => $products,
            'orderItems' => $this->order->items()->get(),
        ]);
    }
}
