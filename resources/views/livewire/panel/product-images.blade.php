<div>
    <script>
        window.addEventListener("clearFileInput", function (e) {
            document.getElementById("imageInput").value = "";
        })
        window.addEventListener("alert", function (e) {
            console.log(e.detail.text);
        })
    </script>

    <form wire:submit.prevent="storeImage" class="mt-4">
        <div class="form-group">
            <label for="imageInput">Upload New Image</label>
            <input type="file" class="form-control" id="imageInput" wire:model="newImage">
        </div>
        @error('image')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror

        <button type="submit" class="btn btn-success mb-3">Save</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody wire:sortable="updateOrder">
        @forelse($product->images as $image)
            <tr wire:sortable.item="{{ $image->id }}" wire:key="image_{{$image->id}}">
                <td><img style="width:150px;height:150px;object-fit:cover;" src="{{asset($image->path)}}"/></td>
                <td>
                    @if($confirmIdToRemove === $image->id)
                        <button draggable="false" wire:click="remove({{$image->id}})" class="btn btn-danger">Are You
                            Sure?
                        </button>
                    @else
                        <button draggable="false" wire:click="confirmRemove({{$image->id}})" class="btn btn-danger">
                            Remove
                        </button>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td>
                    There are no images for this product
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
