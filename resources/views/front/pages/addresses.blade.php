@extends('front.pages.layout', ['title' => 'Addresses'])
@section('content')
    <section class="section-content padding-y">
        <div class="container">
            <div class="text-left"><a href="{{route('front.address.create')}}">
                    <button class="btn btn-success">Create New Address</button>
                </a></div>
            <br/>
            <h1>My Addresses</h1>
            @foreach($addresses as $address)
                <hr>
                <h3>{{$address->address_name}}</h3>
                <p><b>Province: </b> {{$address->province}}</p>
                <p><b>County: </b> {{$address->county}}</p>
                <p>{{$address->address}}</p>
                <a href="{{route('front.address.update', $address)}}">
                    <button class="btn btn-info">Update</button>
                </a>
                <form style="display:inline" method="POST" action="{{route('front.address.destroy', $address)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger ml-2" type="submit">Remove</button>
                </form>
            @endforeach
        </div>
    </section>
@endsection