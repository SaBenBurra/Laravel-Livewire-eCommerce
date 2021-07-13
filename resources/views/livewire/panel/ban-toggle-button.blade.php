<div wire:click="banUser({{$id}})" class="p-1 rounded">
    @if($isBanned)
        <button class="btn btn-success">Unban</button>
        @else
        <button class="btn btn-danger">Ban</button>
    @endif
</div>