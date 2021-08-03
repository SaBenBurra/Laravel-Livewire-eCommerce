@extends('front.pages.layout', ['title' => 'Dashboard'])
@section('content')
    <style>
        .dashboard-navigation-link {
            border: 1px solid gray;
            border-radius: 10px;
            -webkit-transition: 0.5s;
        }

        .dashboard-navigation-link:hover {
            background-color: grey;
            transition-duration: 0.5s;
        }
    </style>
    <section class="section-content padding-y">
        <div class="container">
            <div>
                <p>Hello, {{auth()->user()->name}}</p>
                <p>This is your dashboard</p>
                <div class="row ml-3 mr-3">
                    <a class="col-md" href="{{route('front.profile')}}">
                        <div class="text-center p-4 dashboard-navigation-link">Profile</div>
                    </a>
                    <div class="col-1"></div>
                    <a class="col-md" href="#">
                        <div class="text-center p-4 dashboard-navigation-link">Orders</div>
                    </a>
                    <div class="col-1"></div>
                    <a class="col-md" href="#">
                        <div class="text-center p-4 dashboard-navigation-link">Addresses</div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection