<div>
    <script>
        addEventListener("alert", (e) => alert(e.detail.text));
    </script>
    <form>
        <div class="form-group">
            <label for="newVariantName">Variant Group Name:</label>
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
            <form>
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
            </form>
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
            @error('variantsOfNewVariantGroup')
            {{$message}}
            @enderror
        @endif

        <hr style="border:2px solid black;"/>
        @foreach($productVariantGroups as $variantGroup)

            <h3 class="h3">{{$variantGroup[0]->name->name}}</h3>
            <div class="text-right"><button wire:click="removeVariantGroup({{$variantGroup[0]->name->id}})" type="button" class="btn btn-danger">Remove</button></div>
            @foreach($variantGroup as $variant)
                <div class="row mb-3">
                    <div class="col">
                        <label>Variant Value</label>
                        <select class="form-control" disabled>
                            <option selected>{{$variant->value->value}}</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Variant Price</label>
                        <input type="number" value="{{$variant->price}}" class="form-control" min="0" step="0.05"/>
                    </div>
                    <div class="col">
                        <label>Variant Stock</label>
                        <input type="number" value="{{$variant->stock}}" class="form-control" min="0" step="1"/>
                    </div>
                </div>
            @endforeach

            <hr style="border:1px solid black;"/>
    @endforeach
</div>
