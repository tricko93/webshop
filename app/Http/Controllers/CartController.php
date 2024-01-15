<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getCart();

        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $productName = $request->input('product_name');
        $price = $request->input('price');
        $quantity = $request->input('quantity', 1);

        $this->cartService->addToCart($productName, $price, $quantity);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart($productName)
    {
        $this->cartService->removeFromCart($productName);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }
}
