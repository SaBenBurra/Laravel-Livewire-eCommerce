<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class CartItemPrice extends Component
{
    public $cartItem;
    public $price;

    protected $listeners = ['updatePrice' => 'render'];

    public function render()
    {
        $this->price = $this->cartItem->price() * $this->cartItem->quantity;
        return view('livewire.front.cart-item-price');
    }
}
