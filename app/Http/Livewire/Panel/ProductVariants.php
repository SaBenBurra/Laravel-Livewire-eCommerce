<?php

namespace App\Http\Livewire\Panel;

use App\Models\ProductPropertyName;
use App\Models\ProductPropertyValue;
use App\Models\ProductVariant;
use App\Rules\VariantGroupIsExists;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ProductVariants extends Component
{
    public $product;
    public $propertyNames = [];
    public $productVariantGroups = [];

    public $idOfNewVariantGroupsPropertyName;
    public $newVariantGroupsPropertyName;

    public $propertyValuesOfSelectedVariantPropertyName = [];
    public $variantsOfNewVariantGroup = [];

    public $propertyValueIdOfNewVariant;
    public $priceOfNewVariant;
    public $stockOfNewVariant;

    public $propertyValueOfNewVariant;

    public $variantsToCreateOfVariantGroupsToUpdate = [];

    protected $listeners = ['resetPropertyName' => 'resetPropertyName'];

    private $priceRule = 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:9999999|min:0.01';
    private $stockRule = 'int|min:0|max:9999999';

    public function rules()
    {
        return [
            'propertyValueIdOfNewVariant' => [
                'required',
                'exists:product_property_values,id',
                function ($attribute, $value, $fail) {
                    $propertyValueIds = array_map(function ($item) {
                        return $item['id'];
                    }, $this->newVariantGroupsPropertyName->values->toArray());
                    if (!in_array($value, $propertyValueIds))
                        $fail('Invalid property value');
                },
                function ($attribute, $value, $fail) {
                    foreach ($this->variantsOfNewVariantGroup as $variant) {
                        if ($variant['property_value_id'] == $value)
                            $fail('This property value is already used');
                    }
                }
            ],
            'priceOfNewVariant' => $this->priceRule,
            'stockOfNewVariant' => $this->stockRule,
            'variantsOfNewVariantGroup' => ['min:2', new VariantGroupIsExists($this->productVariantGroups)],
        ];
    }

    public function mount()
    {
        $this->getProductVariantGroups();
        $this->fillVariantsToCreateOfVariantGroupsToUpdate();
        $this->propertyNames = ProductPropertyName::all();
    }

    public function hydrate()
    {
        $this->getProductVariantGroups();
    }

    public function render()
    {
        return view('livewire.panel.product-variants', ['productVariantGroups' => $this->productVariantGroups]);
    }

    public function updatedIdOfNewVariantGroupsPropertyName()
    {
        $this->newVariantGroupsPropertyName = ProductPropertyName::find($this->idOfNewVariantGroupsPropertyName);
        $this->reset('variantsOfNewVariantGroup', 'stockOfNewVariant', 'priceOfNewVariant');
    }

    public function addVariantToNewVariantGroup()
    {
        $this->validateOnly('propertyValueIdOfNewVariant');
        $this->validateOnly('priceOfNewVariant');
        $this->validateOnly('stockOfNewVariant');
        $newVariantDataArray = [
            'product_id' => $this->product->id,
            'property_name_id' => $this->idOfNewVariantGroupsPropertyName,
            'property_value_id' => $this->propertyValueOfNewVariant->id,
            'value' => $this->propertyValueOfNewVariant->value,
            'stock' => $this->stockOfNewVariant,
            'price' => $this->priceOfNewVariant
        ];

        array_push($this->variantsOfNewVariantGroup, $newVariantDataArray);
        $this->reset('propertyValueOfNewVariant', 'propertyValueIdOfNewVariant', 'priceOfNewVariant', 'stockOfNewVariant');
    }

    public function resetPropertyName()
    {
        $this->reset('newVariantGroupsPropertyName', 'idOfNewVariantGroupsPropertyName');
    }

    public function updatedPropertyValueIdOfNewVariant()
    {
        $this->propertyValueOfNewVariant = ProductPropertyValue::find($this->propertyValueIdOfNewVariant);
    }

    public function removeVariantFromNewVariantGroup($valueOfVariantToRemove)
    {
        foreach ($this->variantsOfNewVariantGroup as $key => $variant) {
            if ($variant['value'] == $valueOfVariantToRemove)
                unset($this->variantsOfNewVariantGroup[$key]);
        }
    }

    public function createVariantGroup()
    {
        $this->validateOnly('variantsOfNewVariantGroup');
        $this->validateOnly('productVariantGroups');
        DB::transaction(function () {
            foreach ($this->variantsOfNewVariantGroup as $variant) {
                ProductVariant::create([
                    'product_id' => $variant['product_id'],
                    'property_name_id' => $variant['property_name_id'],
                    'property_value_id' => $variant['property_value_id'],
                    'price' => $variant['price'],
                    'stock' => $variant['stock']
                ]);
            }
        });
        $this->getProductVariantGroups();
        $this->reset('variantsOfNewVariantGroup', 'idOfNewVariantGroupsPropertyName', 'newVariantGroupsPropertyName');
        $this->fillVariantsToCreateOfVariantGroupsToUpdate();
    }

    public function getProductVariantGroups()
    {
        $this->productVariantGroups = ProductVariant::with('value', 'name')->where('product_id', $this->product->id)
            ->get()
            ->groupBy('property_name_id')
            ->toArray();
    }

    public function removeVariantGroup($propertyNameIdOfVariantGroupId)
    {
        ProductVariant::where('product_id', $this->product->id)
            ->where('property_name_id', $propertyNameIdOfVariantGroupId)
            ->delete();
        $this->getProductVariantGroups();
    }

    public function fillVariantsToCreateOfVariantGroupsToUpdate()
    {
        foreach ($this->productVariantGroups as $index => $variantGroup) {
            $this->variantsToCreateOfVariantGroupsToUpdate[$index]['property_value_id'] = 0;
            $this->variantsToCreateOfVariantGroupsToUpdate[$index]['price'] = 0;
            $this->variantsToCreateOfVariantGroupsToUpdate[$index]['stock'] = 0;
        }
    }

    public function getPropertyValuesOfCurrentVariantGroup($variantGroupDataArray)
    {
        return ProductPropertyValue::where('property_name_id', $variantGroupDataArray[0]['property_name_id'])->get();
    }

    public function createVariantToCurrentVariantGroup($propertyNameId, $propertyValueId, $price, $stock)
    {
        Validator::make(
            ['price' => $price],
            ['price' => $this->priceRule]
        )->validate();

        Validator::make(
            ['stock' => $stock],
            ['stock' => $this->stockRule]
        )->validate();

        Validator::make(
            ['propertyValueId' => $propertyValueId],
            ['propertyValueId' =>
                [
                    function ($attribute, $value, $fail) use ($propertyNameId) {

                        if (!ProductPropertyValue::where('id', $value)
                            ->where('property_name_id', $propertyNameId)
                            ->exists())
                            $fail('This value is invalid');
                    },
                    function ($attribute, $value, $fail) use ($propertyNameId) {
                        foreach ($this->productVariantGroups[$propertyNameId] as $variant) {
                            if ($variant['property_value_id'] == $value) {
                                $fail('This value already used');
                            }
                        }
                    }]
            ]
        )->validate();

        ProductVariant::create([
            'product_id' => $this->product->id,
            'property_name_id' => $propertyNameId,
            'property_value_id' => $propertyValueId,
            'price' => $price,
            'stock' => $stock
        ]);
        $this->fillVariantsToCreateOfVariantGroupsToUpdate();
        $this->getProductVariantGroups();
    }

    public function saveVariantChanges($propertyValueId, $price, $stock)
    {
        Validator::make(
            ['price' => $price],
            ['price' => $this->priceRule]
        )->validate();

        Validator::make(
            ['stock' => $stock],
            ['stock' => $this->stockRule]
        )->validate();

        $variant = ProductVariant::where('property_value_id', $propertyValueId)
            ->where('product_id', $this->product->id)
            ->first();
        $variant->price = $price;
        $variant->stock = $stock;
        $variant->save();
        $this->getProductVariantGroups();

        $this->dispatchBrowserEvent('alert', ['text' => 'Success!']);
    }

    public function removeVariant($idOfVariantToRemove, $variantCountOfVariantGroup)
    {
        if ($variantCountOfVariantGroup > 2) {
            ProductVariant::destroy($idOfVariantToRemove);
            $this->getProductVariantGroups();
        }
    }

    public function setVariantPriceForProductPrice($propertyNameId)
    {
        $this->dispatchBrowserEvent('alert', ['text' => 'Success!']);
        DB::transaction(function () use ($propertyNameId) {
            ProductVariant::where('property_name_id', $propertyNameId)
                ->where('product_id', $this->product->id)
                ->update(['is_price_using' => 1]);

            ProductVariant::where('property_name_id', '!=', $propertyNameId)
                ->where('product_id', $this->product->id)
                ->update(['is_price_using' => 0]);

            $this->getProductVariantGroups();
        });
    }
}
