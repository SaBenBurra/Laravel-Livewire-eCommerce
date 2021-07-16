<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard() {
        return view('panel.pages.dashboard');
    }

    public function users() {
        return view('panel.pages.users');
    }

    public function productImages(Product $product) {
        return view('panel.pages.product-images', compact('product'));
    }
}
