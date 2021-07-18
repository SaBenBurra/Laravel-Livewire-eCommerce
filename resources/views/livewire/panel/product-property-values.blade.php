<div>
    <form wire:submit.prevent="createValue">
        <div class="input-group mb-3">
            <input wire:model.defer="newValue" type="text" class="form-control" placeholder="property value..."
                   aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button type="submit" class="btn btn-success" id="basic-addon2">add</button>
            </div>
        </div>
        @error('newValue')
        {{$message}}
        @enderror
    </form>
    <hr/>
    <br/>
    @forelse($this->currentValuesAsString as $index => $value)
        <form wire:submit.prevent="updateValue({{$index}})">
            <div class="input-group mb-3" wire:key="row_{{$index}}">
                <input wire:model.defer="currentValuesAsString.{{$index}}" type="text" class="form-control"
                       placeholder="property value..."
                       aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
                <div class="input-group-append">
                    <button wire:click="remove({{$index}})" type="button" class="btn btn-danger">remove</button>
                </div>
            </div>
            @error("currentValuesAsString".$index)
            {{$message}}
            @enderror
        </form>
    @empty
        There are no values for this property
    @endforelse
</div>
