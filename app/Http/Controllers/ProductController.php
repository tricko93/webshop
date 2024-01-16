<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category_id');

        $products = Product::query();

        if (!empty($category)) {
            $products->where('category_id', $category);
        }

        if (!empty($search)) {
            $products = $products->where('name', 'like', '%' . $search . '%');
        }

        $products = $products->paginate(15);

        return view('products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
