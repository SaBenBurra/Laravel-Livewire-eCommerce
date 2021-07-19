<div>
    <script>
        window.addEventListener("alert", (e) => alert(e.detail.text))
    </script>
    <form wire:submit.prevent="createProperty">
        <div class="form-group">
            <label for="propertyName">Property Name:</label>
            <select wire:model.defer="newPropertyNameId" wire:change="getPropertyValues()" id="propertyName"
                    class="form-control">
                <option hidden selected>Please select</option>
                @forelse($propertyNames as $propertyName)
                    <option value="{{$propertyName->id}}">{{$propertyName->name}}</option>
                @empty
                    <script>
                        alert("Please create some property names and values before add property to product");
                        window.location.href = "{{route('panel.product.index')}}";
                    </script>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="propertyValue">Property Value:</label>
            <select wire:model.defer="newPropertyValueId" id="propertyValue" class="form-control">
                @forelse($propertyValues as $propertyValue)
                    <option value="{{$propertyValue->id}}">{{$propertyValue->value}}</option>
                @empty
                    @if($newPropertyValueId)
                        <option>Please add values for this property</option>
                    @endif
                @endforelse
            </select>
        </div>
        <input type="submit" class="form-control btn btn-primary" value="Add"/>
    </form>
    <ul class="list-group mt-4">
        @forelse($product->properties as $property)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><b>{{$property->propertyName->name}}</b> => {{$property->propertyValue->value}}</span>
                <span wire:click="removeProperty({{$property->id}})" class="btn btn-danger">X</span></li>
        @empty
            There are no properties for this product.
        @endforelse
    </ul>


</div>
