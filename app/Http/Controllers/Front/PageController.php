<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FavoriteProduct;
use App\Models\Product;

class PageController extends Controller
{
    public function main()
    {
        $lastProducts = Product::limit(8)->orderBy('id', 'desc')->get();
        $categories = Category::all();
        return view('front.pages.main-page', compact('lastProducts', 'categories'));
    }

    public function productDetail(Product $product)
    {
        return view('front.pages.product-detail', compact('product'));
    }

    public function cart()
    {
        return view('front.pages.cart');
    }

    public function dashboard()
    {
        return view('front.pages.dashboard');
    }

    public function profile()
    {
        return view('front.pages.profile');
    }

    public function favorites()
    {
        $favoriteProducts = FavoriteProduct::where('user_id', auth()->id())
            ->with('product')
            ->get();
        return view('front.pages.favorites', compact('favoriteProducts'));
    }

    public function productsByCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)->paginate(12);
        return view('front.pages.product-listby-category', compact('products', 'category'));
    }
}
