@extends('front.pages.layout', ['title' => 'Create Address'])
@section('content')
    <section class="section-content padding-y">
        <div class="container">
            <div class="text-left">
                <h2>Address Creating Page</h2>
            </div>
            <form method="POST" action="{{route('front.address.store')}}">
                <div class="form-group">
                    <label for="address_name">Address Name:</label>
                    <input type="text" class="form-control" id="address_name" name="address_name"/>
                    @error('address_name')
                    {{$message}}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address"></textarea>
                    @error('address')
                    {{$message}}
                    @enderror
                </div>
                <input type="submit" class="form-control btn btn-success" value="Create">
            </form>
        </div>
    </section>
@endsection