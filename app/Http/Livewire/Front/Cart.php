<?php

namespace App\Http\Livewire\Front;

use App\Models\CartItem;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems;

    public function mount()
    {
        $this->getCartItems();
    }

    public function render()
    {
        return view('livewire.front.cart');
    }

    public function removeItem($cartItemId)
    {
        CartItem::destroy($cartItemId);
        $this->getCartItems();
    }

    public function getCartItems()
    {
        $this->cartItems = CartItem::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
    }
}
