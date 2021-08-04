<?php

namespace App\Http\Livewire\Front;

use App\Models\FavoriteProduct;
use Livewire\Component;

class FavoriteButton extends Component
{
    public $product;
    public $isFavorite;

    public function mount()
    {
        $this->checkIsFavorite();
    }

    public function render()
    {
        return view('livewire.front.favorite-button');
    }

    public function addToFavorites()
    {
        FavoriteProduct::create([
            'product_id' => $this->product->id,
            'user_id' => auth()->id()
        ]);
        $this->isFavorite = true;
    }

    public function removeFromFavorites()
    {
        FavoriteProduct::where('product_id', $this->product->id)
            ->delete();
        $this->isFavorite = false;
    }

    private function checkIsFavorite()
    {
        $isFavorite = FavoriteProduct::where('product_id', $this->product->id)
            ->where('user_id', auth()->id())
            ->exists();

        $this->isFavorite = $isFavorite;
    }
}
