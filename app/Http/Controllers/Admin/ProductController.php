<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Rules\ProductSlugUnique;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return view('panel.pages.products');
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('panel.pages.product-create-page', ['categories' => $categories, 'brands' => $brands]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:450',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:9999999|min:0.01',
            'slug' => ['required', 'string', 'min:10', 'max:500', 'unique:products,slug'],
            'stock' => 'int|min:0|max:9999999',
            'description' => 'string|min:10|max:1400',
        ]);

        $newProduct = new Product;
        $newProduct->fill($request->all());
        $newProduct->generateSerialNumber();
        $newProduct->save();

        return redirect()->route('panel.product.index');

    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('panel.pages.product-edit-page', ['product' => $product, 'categories' => $categories, 'brands' => $brands]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:3|max:450',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:9999999|min:0.01',
            'slug' => ['required', 'string', 'min:10', 'max:500', new ProductSlugUnique($request->id)],
            'stock' => 'int|min:0|max:9999999',
            'description' => 'string|min:10|max:1400',
        ]);

        $product->update($request->all());
        return redirect()->route('panel.product.index');
    }
}
