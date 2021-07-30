<?php

namespace App\Http\Livewire\Front;

use App\Models\CartItem;
use Livewire\Component;

class CartIcon extends Component
{
    public $chartCount;

    protected $listeners = ['updateCart' => 'render'];

    public function render()
    {
        $this->chartCount = CartItem::count();
        return view('livewire.front.cart-icon');
    }
}
