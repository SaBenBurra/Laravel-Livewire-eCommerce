<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class ProductDetail extends Component
{
    public $product;

    public function render()
    {
        return view('livewire.front.product-detail');
    }
}
