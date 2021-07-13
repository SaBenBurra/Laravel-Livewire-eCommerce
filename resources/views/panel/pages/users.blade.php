@extends('panel.pages.layout', ['title' => 'Users'])
@section('content')
    <script>
        window.addEventListener('alert', function (e) {
            alert(e.detail.text);
        });
    </script>
    <h1 class="h3">Users</h1>
    <livewire:tables.user-datatable/>
@endsection