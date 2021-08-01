<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class CartItemQuantity extends Component
{
    public $cartItem;
    public $quantity;

    public function mount()
    {
        $this->quantity = $this->cartItem->quantity;
    }

    public function render()
    {
        return view('livewire.front.cart-item-quantity');
    }

    public function updatedQuantity()
    {
        $this->cartItem->quantity = $this->quantity;
        $this->cartItem->save();

        $this->emit('updatePrice');
    }
}
