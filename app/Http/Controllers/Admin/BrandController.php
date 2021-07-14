<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    private $rules = [
        'brandName' => 'required|max:50|unique:brands,name'
    ];

    public function index()
    {
        return view('panel.pages.brands');
    }

    public function create()
    {
        return view('panel.pages.brand-create-page');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);

        Brand::create([
            'name' => $request->brandName
        ]);

        return redirect()->route('panel.brand.index');
    }

    public function edit(Brand $brand)
    {
        return view('panel.pages.brand-edit-page', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate($this->rules);

        $brand->update([
            'name' => $request->brandName
        ]);

        return redirect()->route('panel.brand.index');
    }
}
