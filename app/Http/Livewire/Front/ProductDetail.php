<?php

namespace App\Http\Livewire\Front;

use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;

    public $variantGroups;
    public $allVariants = [];
    public $price;
    public $singlePrice;

    public $idsOfSelectedVariants = [];

    public $quantity = 1;

    public function render()
    {
        return view('livewire.front.product-detail');
    }

    public function mount()
    {
        $this->variantGroups = ProductVariant::with('value', 'name')
            ->where('product_id', $this->product->id)
            ->where('stock', '>', 0)
            ->get()
            ->groupBy('property_name_id')
            ->toArray();

        foreach ($this->variantGroups as $variantGroup) {
            $propertyNameId = $variantGroup[0]['property_name_id'];
            $this->idsOfSelectedVariants[$propertyNameId] = null;

            $lowestPriceVariant = null;

            foreach ($variantGroup as $variant) {
                if (!$lowestPriceVariant || $variant['price'] < $lowestPriceVariant['price'])
                    $lowestPriceVariant = $variant;
                array_push($this->allVariants, $variant);
            }

            $this->idsOfSelectedVariants[$propertyNameId] = $lowestPriceVariant['id'];
        }
        $this->calculatePrice();
    }

    public function increaseQuantity()
    {
        $this->quantity += 1;
        $this->calculatePrice();
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity -= 1;
            $this->calculatePrice();
        }
    }

    public function addToCart()
    {
        if (!auth()->check())
            return redirect()->route('login');
        foreach ($this->idsOfSelectedVariants as $variantId) {
            $variant = ProductVariant::find($variantId);
            if ($variant->stock < $this->quantity) {
                $this->dispatchBrowserEvent('alert', ['text' => $variant->stock . " stock left"]);
                return false;
            }
        }
        $variantsIdsAsInteger = array_map(function ($item) {
            return intval($item);
        }, $this->idsOfSelectedVariants);
        CartItem::updateOrCreate(
            [
                'product_id' => $this->product->id,
                'user_id' => auth()->id(),
                'variants' => json_encode(array_values($variantsIdsAsInteger)),
            ],
            [
                'quantity' => DB::raw('quantity + ' . $this->quantity),
            ]
        );
        $this->emit('updateCart');
    }

    public function calculatePrice()
    {
        foreach ($this->idsOfSelectedVariants as $variantId) {
            $variant = ProductVariant::find($variantId);
            if ($variant->is_price_using === 1) {
                $this->singlePrice = $variant->price;
                $this->price = $this->singlePrice * $this->quantity;
                return false;
            }
        }
        $this->singlePrice = $this->product->price;
        $this->price = $this->singlePrice * $this->quantity;
    }

    public function updatedIdsOfSelectedVariants()
    {
        $this->calculatePrice();
    }

    public function multiplyPriceAndQuantity()
    {
        $this->price = $this->singlePrice * $this->quantity;
    }
}
