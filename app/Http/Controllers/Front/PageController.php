<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main () {
        $lastProducts = Product::limit(8)->orderBy('id', 'desc')->get();
        return view('front.pages.main-page', compact('lastProducts'));
    }

    public function productDetail(Product $product) {
        return view('front.pages.product-detail', compact('product'));
    }

    public function cart() {
        return view('front.pages.cart');
    }

    public function dashboard() {
        return view('front.pages.dashboard');
    }
}
