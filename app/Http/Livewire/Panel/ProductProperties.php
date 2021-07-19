<?php

namespace App\Http\Livewire\Panel;

use App\Models\ProductProperty;
use App\Models\ProductPropertyName;
use Livewire\Component;

class ProductProperties extends Component
{
    public $product;
    public $newProperty;
    public $currentProperties;
    public $currentPropertiesAsString;

    public $propertyNames = [];
    public $propertyValues = [];

    public $newPropertyNameId;
    public $newPropertyValueId;

    protected $rules = [
        'newPropertyNameId' => 'required|exists:product_property_names,id',
        'newPropertyValueId' => 'required|exists:product_property_values,id',
    ];

    public function mount()
    {
        $this->propertyNames = ProductPropertyName::all();
    }

    public function render()
    {
        return view('livewire.panel.product-properties');
    }

    public function getPropertyValues()
    {
        //$this->dispatchBrowserEvent("alert", ["text" => $this->nameOfNewProperty]);
        $this->propertyValues = ProductPropertyName::find($this->newPropertyNameId)->values;
    }

    public function createProperty()
    {
        $this->validate();
        try {
            ProductProperty::create([
                'product_id' => $this->product->id,
                'property_name_id' => $this->newPropertyNameId,
                'property_value_id' => $this->newPropertyValueId
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['text' => "This property already added"]);
        }
        $this->product->refresh();
    }

    public function removeProperty($propertyId) {
        ProductProperty::destroy($propertyId);
        $this->product->refresh();
    }
}
