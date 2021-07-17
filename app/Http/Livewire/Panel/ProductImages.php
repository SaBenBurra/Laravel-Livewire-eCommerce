<?php

namespace App\Http\Livewire\Panel;

use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImages extends Component
{
    use WithFileUploads;

    public $product;
    public $newImage;
    public $confirmIdToRemove;

    public function render()
    {
        return view('livewire.panel.product-images');
    }

    public function storeImage()
    {
        $this->validate([
            'newImage' => 'required|image|max:1024',
        ]);

        $imageFileExtension = $this->newImage->extension();
        $pathToStoreImage = config('global.product_images_storage_path');
        $imageFileName = uniqid() . "." . $imageFileExtension;

        $this->newImage->storeAs($pathToStoreImage, $imageFileName);

        try {
            $productImage = new ProductImage;
            $productImage->product_id = $this->product->id;
            $productImage->setPlaceNumber($this->product->id);
            $productImage->path = config('global.product_images_asset_path') . $imageFileName;
            $productImage->save();
        } catch (\Exception $e) {
            unlink($pathToStoreImage . $imageFileName);
        }

        $this->product->refresh();
        $this->reset(['newImage']);
        $this->dispatchBrowserEvent("clearFileInput");
    }

    public function updateOrder($list)
    {
        ProductImage::resetPlaceNumbers($this->product->id);
        foreach ($list as $item) {
            $productImage = ProductImage::find($item["value"]);
            $productImage->place_number = $item["order"];
            $productImage->save();
        }
        $this->product->refresh();
    }

    public function confirmRemove($imageId)
    {
        $this->confirmIdToRemove = $imageId;
    }

    public function remove($imageId)
    {
        ProductImage::destroy($imageId);
        $this->product->refresh();
    }
}
