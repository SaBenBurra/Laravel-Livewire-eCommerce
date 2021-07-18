<?php

namespace App\Http\Livewire\Panel;

use App\Models\ProductPropertyValue;
use Livewire\Component;

class ProductPropertyValues extends Component
{
    public $productPropertyName;
    public $newValue;
    public $currentValues;
    public $currentValuesAsString;

    protected $rules = [
        'newValue' => 'required|max:50|unique:product_property_values,value'
    ];

    public function render()
    {
        $this->productPropertyName->refresh();
        $this->currentValues = $this->productPropertyName->values;
        $this->currentValuesAsString = array_map(function ($item) {
            return $item['value'];
        }, $this->currentValues->toArray());
        return view('livewire.panel.product-property-values');
    }

    public function createValue()
    {
        $this->validate();

        ProductPropertyValue::create([
            'property_name_id' => $this->productPropertyName->id,
            'value' => $this->newValue
        ]);
        $this->productPropertyName->refresh();
        $this->reset('newValue');
    }

    public function updateValue($index)
    {
        ProductPropertyValue::find($this->currentValues[$index]['id'])->update([
            'value' => $this->currentValuesAsString[$index]
        ]);
    }

    public function remove($index)
    {
        ProductPropertyValue::destroy($this->currentValues[$index]['id']);
        unset($this->currentValuesAsString[$index]);
    }
}
