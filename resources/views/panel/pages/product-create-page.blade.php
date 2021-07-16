@extends('panel.pages.layout', ['title' => 'Category Creation Page'])
@section('content')

    <form method="POST" action="{{route('panel.product.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" type="text" value="{{ old('name') }}" name="name" id="name"/>
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" name="category_id" id="category">
                @forelse($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @empty
                    <script>
                        alert("Please create some categories before add product");
                        window.location.href = "{{route('panel.product.index')}}";
                    </script>
                @endforelse
            </select>
            @error('category_id')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="brand">Brand:</label>
            <select class="form-control" name="brand_id" id="brand">
                @forelse($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @empty
                    <script>
                        alert("Please create some brands before add product");
                        window.location.href = "{{route('panel.product.index')}}";
                    </script>
                @endforelse
            </select>
            @error('brand_id')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description"
                      class="form-control">{{ old('description') }}</textarea>
            @error('description')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control" value="{{ old('slug') }}" name="slug" id="slug"/>
            @error('slug')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" min="0" value="1.00" step="0.05" id="price" name="price"/>
            @error('price')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" class="form-control" min="0" value="1" step="1" id="stock" name="stock"/>
            @error('stock')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
        </div>

        <input class="form-control" type="submit" value="Create"/>
    </form>
@endsection