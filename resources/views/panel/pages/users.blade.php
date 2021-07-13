@extends('panel.pages.layout', ['title' => 'Users'])
@section('content')
    <script>
        window.addEventListener('alert', function (e) {
            alert(e.detail.text);
        });
    </script>
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <livewire:tables.user-datatable/>
@endsection