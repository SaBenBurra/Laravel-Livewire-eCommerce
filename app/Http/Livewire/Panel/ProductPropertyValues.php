<?php

namespace App\Http\Livewire\Panel;

use App\Models\ProductPropertyValue;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Rules\ProductPropertyValueUnique;

class ProductPropertyValues extends Component
{
    public $productPropertyName;
    public $newValue;
    public $currentValues;
    public $currentValuesAsString;

    public function rules()
    {
        return [
            'newValue' => ['required', 'max:50', new ProductPropertyValueUnique($this->productPropertyName->id)],
        ];
    }

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
        $this->validateOnly('newValue');

        ProductPropertyValue::create([
            'property_name_id' => $this->productPropertyName->id,
            'value' => $this->newValue
        ]);
        $this->productPropertyName->refresh();
        $this->reset('newValue');
    }

    public function updateValue($index)
    {
        $valueToUpdate = $this->currentValuesAsString[$index];

        Validator::make(
            ['valueToUpdate' => $valueToUpdate],
            ['valueToUpdate' => ['required', 'max:50', new ProductPropertyValueUnique($this->productPropertyName->id)]]
        )->validate();

        ProductPropertyValue::find($this->currentValues[$index]['id'])->update([
            'value' => $valueToUpdate
        ]);
    }

    public function remove($index)
    {
        ProductPropertyValue::destroy($this->currentValues[$index]['id']);
        unset($this->currentValuesAsString[$index]);
    }
}
