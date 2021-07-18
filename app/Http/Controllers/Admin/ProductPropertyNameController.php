<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductPropertyNameRequest;
use App\Http\Requests\UpdateProductPropertyNameRequest;
use App\Models\ProductPropertyName;
use Illuminate\Http\Request;

class ProductPropertyNameController extends Controller
{
    public function index()
    {
        $productPropertyNames = ProductPropertyName::all();
        return view('panel.pages.product-property-names', compact('productPropertyNames'));
    }

    public function create()
    {
        return view('panel.pages.product-property-name-create-page');
    }

    public function store(StoreProductPropertyNameRequest $request)
    {
        ProductPropertyName::create($request->validated());

        return redirect()->route('panel.productPropertyName.index');
    }

    public function show(ProductPropertyName $productPropertyName)
    {
        return view('panel.pages.product-property-values', compact('productPropertyName'));
    }

    public function edit(ProductPropertyName $productPropertyName)
    {
        return view('panel.pages.product-property-name-edit-page', compact('productPropertyName'));
    }

    public function update(UpdateProductPropertyNameRequest $request, ProductPropertyName $productPropertyName)
    {
        $productPropertyName->update($request->validated());
        return redirect()->route('panel.productPropertyName.index');
    }

    public function destroy(ProductPropertyName $productPropertyName)
    {
        $productPropertyName->delete();
        return redirect()->route('panel.productPropertyName.index');
    }
}
