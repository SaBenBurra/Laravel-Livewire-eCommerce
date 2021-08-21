@extends('front.pages.layout', ['title' => 'Update Address'])
@section('content')
    <section class="section-content padding-y">
        <div class="container">
            <div class="text-left">
                <h2>Address Updating Page</h2>
            </div>
            <form method="POST" action="{{route('front.address.update', $address)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="address_name">Address Name:</label>
                    <input type="text" class="form-control" value="{{$address->address_name}}" id="address_name"
                           name="address_name"/>
                    @error('address_name')
                    {{$message}}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="province">Province:</label>
                    <input type="text" class="form-control" value="{{$address->province}}" id="province"
                           name="province"/>
                    @error('province')
                    {{$message}}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="county">County:</label>
                    <input type="text" class="form-control" value="{{$address->county}}" id="county" name="county"/>
                    @error('county')
                    {{$message}}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address">{{$address->address}}</textarea>
                    @error('address')
                    {{$message}}
                    @enderror
                </div>
                <input type="submit" class="form-control btn btn-success" value="Update">
            </form>
        </div>
    </section>
@endsection