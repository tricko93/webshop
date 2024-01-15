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
        $productId = $request->input('product_id');
        $productName = $request->input('product_name');
        $price = $request->input('price');
        $quantity = $request->input('quantity', 1);

        if (auth()->check()) {
            // If the user is logged in, associate the cart data with the user
            $this->cartService->addToCartForUser(auth()->id(), $productId, $productName, $price, $quantity);
        } else {
            // If the user is not logged in, store the cart data in the session
            $this->cartService->addToSessionCart($productId, $productName, $price, $quantity);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart($productId)
    {
        $this->cartService->removeFromCart($productId);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }
}
