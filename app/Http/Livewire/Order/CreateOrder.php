<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CreateOrder extends Component
{
    public $order;
    public $search = '';
    public $customerName;
    public $itemsCount = 0;

    public function mount()
    {
        $orderOpen = Order::where('closed', 0)->latest()->first();

        if ($orderOpen == null) {
            $this->order = Order::create([
                'customer' => 'VENTA',
                'date' => NOW(),
            ]);
        } else {
            $this->order = $orderOpen;
        }
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
    }

    public function increaseQuantity(OrderItem $orderItem)
    {
        $orderItem->update([
            'quantity' => $orderItem->quantity + 1,
        ]);

        $this->order->update([
            'total' => $this->order->total + $orderItem->product->price,
        ]);
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
    }

    public function render()
    {
        $this->itemsCount = $this->order->items()->count();

        $products = Product::query()
            ->searchProduct($this->search)
            ->get();

        return view('livewire.order.create-order', [
            'products' => $products,
            'orderItems' => $this->order->items()->get(),
        ]);
    }
}
