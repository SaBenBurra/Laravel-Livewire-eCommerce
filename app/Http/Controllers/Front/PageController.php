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
}
