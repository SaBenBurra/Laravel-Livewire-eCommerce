@extends('front.pages.layout', ['title' => 'Register'])
@section('content')
<section class="section-content padding-y">

    <!-- ============================ COMPONENT REGISTER   ================================= -->
    <div class="card mx-auto" style="max-width:520px; margin-top:40px;">
        <article class="card-body">
            <header class="mb-4"><h4 class="card-title">Sign up</h4></header>
            <form method="POST" action="{{route('register')}}">
                @csrf
                <div class="form-row">
                    <div class="col form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="">
                        @error('name') {{$message}} @enderror
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row end.// -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="">
                    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                    @error('email') {{$message}} @enderror
                </div> <!-- form-group end.// -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Create password</label>
                        <input name="password" class="form-control" type="password">
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Repeat password</label>
                        <input name="password_confirmation" class="form-control" type="password">
                    </div> <!-- form-group end.// -->
                </div>
                @error('password') {{$message}} @enderror
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Register  </button>
                </div> <!-- form-group// -->
                <div class="form-group">
                    <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> I am agree with <a href="#">terms and contitions</a>  </div> </label>
                </div> <!-- form-group end.// -->
            </form>
        </article><!-- card-body.// -->
    </div> <!-- card .// -->
    <p class="text-center mt-4">Have an account? <a href="">Log In</a></p>
    <br><br>
    <!-- ============================ COMPONENT REGISTER  END.// ================================= -->


</section>

@endsection