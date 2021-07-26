<div>
    <script>
        addEventListener("alert", (e) => alert(e.detail.text));
        addEventListener("log", (e) => console.log(e.detail.text));
    </script>
    <h2 class="h2">Create New Variant Group</h2>
    <div class="form-group">
        <label for="newVariantName">Select Variant Group Name To Create:</label>
        <select wire:model="idOfNewVariantGroupsPropertyName" class="form-control">
            <option selected hidden>Please select a property name to create a variant group</option>
            @forelse($propertyNames as $propertyName)
                <option value="{{$propertyName->id}}">{{$propertyName->name}}</option>
            @empty
                <script>
                    alert("Please create some product properties before create variants");
                    window.location.href = "{{route('panel.product.edit', [$product])}}";
                </script>
            @endforelse
        </select>
    </div>
    @if(!is_null($newVariantGroupsPropertyName))
        <div class="row">
            <div class="col-3"><label for="propertyValueIdOfNewVariant">New variant's property value:</label>
            </div>
            <div class="col-3"><label for="priceOfNewVariant">Price:</label>
            </div>
            <div class="col-3"><label for="stockOfNewVariant">Stock:</label>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">

                    <select wire:model="propertyValueIdOfNewVariant" class="form-control"
                            id="propertyValueIdOfNewVariant">
                        <option selected hidden>Please select a property</option>
                        @forelse($newVariantGroupsPropertyName->values as $propertyValue)
                            <option value="{{$propertyValue->id}}">{{$propertyValue->value}}</option>

                        @empty
                            @php
                                $this->emit('resetPropertyName');
                            @endphp
                            <script>
                                alert("Please create some values for this property name");
                            </script>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input wire:model.defer="priceOfNewVariant" id="priceOfNewVariant" type="number"
                           class="form-control" min="0" step="0.05"
                    />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input wire:model.defer="stockOfNewVariant" id="stockOfNewVariant" type="number"
                           class="form-control" min="0" step="1"/>
                </div>
            </div>
            <div class="col-3">
                <button wire:click.prevent="addVariantToNewVariantGroup" class="btn btn-success"><i
                            class="fa fa-plus"></i></button>
            </div>
        </div>
        @error('propertyValueIdOfNewVariant')
        {{$message}}
        @enderror
    @endif
    @if($variantsOfNewVariantGroup)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Property Value</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Remove</th>
            </tr>
            </thead>
            <tbody>
            @foreach($variantsOfNewVariantGroup as $variant)
                <tr>
                    <td>{{$variant['value']}}</td>
                    <td>{{$variant['price']}}</td>
                    <td>{{$variant['stock']}}</td>
                    <td>
                        <button wire:click="removeVariantFromNewVariantGroup('{{$variant['value']}}')" type="button"
                                class="btn btn-danger">Remove
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <button wire:click="createVariantGroup" type="button" class="btn btn-success mb-3">Create</button>
        </div>

        @error('variantsOfNewVariantGroup') {{$message}} @enderror
        @error('stockOfNewVariant') {{$message}} @enderror
        @error('priceOfNewVariant') {{$message}} @enderror
    @endif

    <hr style="border:2px solid black;"/>
    @error('price') {{$message}} @enderror
    @error('stock') {{$message}} @enderror
    @error('propertyValueId') {{$message}} @enderror
    @forelse($productVariantGroups as $variantGroupIndex => $variantGroup)
        @if($loop->first)
            <h2 class="h2">Variants</h2>
            @endif
        <div wire:key="variantGroup_{{$variantGroupIndex}}">
            <div class="mt-3" style="display:flex;justify-content: space-between"><h3
                        class="h3">{{$variantGroup[0]['name']['name']}}</h3>
                <div>
                    @if($variantGroup[0]['is_price_using'] == 1)
                        <button wire:key="usingPrice_{{$variantGroup[0]['property_name_id']}}"
                                class="btn btn-dark" style="cursor:default">Prices Using
                        </button>
                    @else
                        <button wire:click="setVariantPriceForProductPrice({{$variantGroup[0]['property_name_id']}})"
                                wire:key="usePrice_{{$variantGroup[0]['property_name_id']}}"
                                class="btn btn-info">Use This Variant's Price
                        </button>
                    @endif
                    <button wire:click="removeVariantGroup({{$variantGroup[0]['name']['id']}})" type="button"
                            class="btn btn-danger ml-3">Remove
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col">Variant Value</div>
                <div class="col">Variant Price</div>
                <div class="col">Variant Stock</div>
                <div class="col"></div>
            </div>
            @foreach($variantGroup as $variantIndex => $variant)
                <div class="row mb-3" wire:key="variant_{{$variant['id']}}">
                    <div class="col">
                        <select wire:model="productVariantGroups.{{$variantGroupIndex}}.{{$variantIndex}}.property_value_id"
                                class="form-control" disabled>
                            <option selected>{{$variant['value']['value']}}</option>
                        </select>
                    </div>
                    <div class="col">
                        <input wire:model="productVariantGroups.{{$variantGroupIndex}}.{{$variantIndex}}.price"
                               type="number" class="form-control"
                               min="0" step="0.05"/>
                    </div>
                    <div class="col">
                        <input wire:model="productVariantGroups.{{$variantGroupIndex}}.{{$variantIndex}}.stock"
                               type="number" class="form-control"
                               min="0" step="1"/>
                    </div>
                    <div class="col">
                        <button wire:click="saveVariantChanges({{$variant['property_value_id']}}, {{$variant['price']}}, {{$variant['stock']}})"
                                class="btn btn-success">Save
                        </button>
                        <button wire:click="removeVariant({{$variant['id']}}, {{count($variantGroup)}})"
                                class="btn btn-danger ml-4">Remove
                        </button>
                    </div>

                </div>
            @endforeach
            <form wire:submit.prevent="createVariantToCurrentVariantGroup({{$variantGroup[0]['property_name_id']}}, {{$variantsToCreateOfVariantGroupsToUpdate[$variantGroupIndex]['property_value_id']}}, {{$variantsToCreateOfVariantGroupsToUpdate[$variantGroupIndex]['price']}}, {{$variantsToCreateOfVariantGroupsToUpdate[$variantGroupIndex]['stock']}})">
                <div class="row mb-3">
                    <div class="col">
                        <select wire:model="variantsToCreateOfVariantGroupsToUpdate.{{$variantGroupIndex}}.property_value_id"
                                class="form-control">
                            <option selected hidden>Please select a property</option>
                            @foreach($this->getPropertyValuesOfCurrentVariantGroup($variantGroup) as $value)
                                <option value="{{$value->id}}">{{$value->value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input wire:model="variantsToCreateOfVariantGroupsToUpdate.{{$variantGroupIndex}}.price"
                               type="number" class="form-control" min="0" step="0.05">
                    </div>
                    <div class="col">
                        <input
                                wire:model="variantsToCreateOfVariantGroupsToUpdate.{{$variantGroupIndex}}.stock"
                                type="number" class="form-control" min="0" step="1"></div>
                    <div class="col">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </form>
            <hr style="border:1px solid black;"/>
        </div>
        @empty
        <h4 class="h4 mt-3">There are no variants for this product...</h4>
    @endforelse
</div>
