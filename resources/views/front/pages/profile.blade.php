@extends('front.pages.layout', ['title' => 'Profile'])
@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4">Profile</h4>
                <form method="POST" action="{{route('front.updateUserData')}}">
                    @csrf
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{auth()->user()->name}}">
                            @error('name')
                            {{$message}}
                            @enderror
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" value="{{auth()->user()->email}}">
                            @error('email')
                            {{$message}}
                            @enderror
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row.// -->

                    <button class="btn btn-primary btn-block">Save</button>
                </form>
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->

        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4">Password</h4>
                <form method="POST" action="{{route('front.updateUserPassword')}}">
                    @csrf
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Old Password</label>
                            <input name="oldPassword" type="password" class="form-control">
                            @error('oldPassword')
                            {{$message}}
                            @enderror
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row.// -->

                    <div class="col form-group">
                        <label>New Password</label>
                        <input name="newPassword" type="password" class="form-control">
                        @error('newPassword')
                        {{$message}}
                        @enderror
                    </div> <!-- form-group end.// -->

                    <div class="col form-group">
                        <label>New Password Confirm</label>
                        <input name="newPassword_confirmation" type="password" class="form-control">
                        @error('newPassword_confirmation')
                        {{$message}}
                        @enderror
                    </div> <!-- form-group end.// -->

                    <button class="btn btn-primary btn-block">Save</button>
                </form>
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->
    </div>
@endsection