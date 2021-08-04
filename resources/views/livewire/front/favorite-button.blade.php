<div>
    @if($isFavorite === false)
        <a wire:click.prevent="addToFavorites" class="btn  btn-danger">Add to favorites <i
                    class="fas fa-heart"></i></a>
    @else
        <a wire:click.prevent="removeFromFavorites" class="btn  btn-secondary" style="color:white;">Remove from
            favorites <i
                    class="fas fa-heart-broken"></i></a>
    @endif
</div>
