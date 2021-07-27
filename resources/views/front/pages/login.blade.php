@extends('front.pages.layout', ['title' => 'Login'])
@section('content')
    <section class="section-conten padding-y" style="min-height:84vh">

        <!-- ============================ COMPONENT LOGIN   ================================= -->
        <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
            <div class="card-body">
                <h4 class="card-title mb-4">Sign in</h4>
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="form-group">
                        <input name="email" class="form-control" placeholder="Email" type="email">
                        @error('email') {{$message}} @enderror
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <input name="password" class="form-control" placeholder="Password" type="password">
                        @error('password') {{$message}} @enderror
                    </div> <!-- form-group// -->

                    <div class="form-group">
                        <a href="#" class="float-right">Forgot password?</a>
                        <label class="float-left custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> Remember </div> </label>
                    </div> <!-- form-group form-check .// -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                    </div> <!-- form-group// -->
                </form>
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->

        <p class="text-center mt-4">Don't have account? <a href="{{route('register')}}">Sign up</a></p>
        <br><br>
        <!-- ============================ COMPONENT LOGIN  END.// ================================= -->


    </section>
@endsection