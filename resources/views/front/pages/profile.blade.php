@extends('front.pages.layout', ['title' => 'Profile'])
@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title mb-4">Profile</h4>
                <form>
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="John">
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="Michael">
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row.// -->

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Country</label>
                            <select id="inputState" class="form-control">
                                <option> Choose...</option>
                                <option selected>Turkey</option>
                                <option>Azerbaijan</option>
                                <option>Turkmenistan</option>
                                <option>Kazakhistan</option>
                                <option>Uzbekistan</option>
                            </select>
                        </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                            <label>City</label>
                            <input type="text" class="form-control">
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row.// -->

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Zip</label>
                            <input type="text" class="form-control" value="123009">
                        </div> <!-- form-group end.// -->
                        <div class="form-group col-md-6">
                            <label>Phone</label>
                            <input type="text" class="form-control" value="+123456789">
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row.// -->

                    <button class="btn btn-primary btn-block">Save</button>
                </form>
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->
    </div>
@endsection