<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartService
{
	public function getCart()
    {
        $userId = Auth::id();
        $sessionId = Session::getId();

        // Get the user's cart items from the database
        $userCart = Cart::where('user_id', $userId)->get();

        // Get the session cart items
        $sessionCart = Session::get('cart', []);

        // Merge user's cart items with session cart items
        $mergedCart = $userCart->concat($sessionCart);

        return $mergedCart;
    }

	public function addToCartForUser($userId, $productId, $productName, $price, $quantity)
    {
    	// Retrieve the Session ID
    	$sessionId = Session::getId();

        // Check if the product is already in the user's cart
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Update the quantity if the product is already in the cart
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Add the product to the user's cart
            Cart::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $productId,
                'product_name' => $productName,
                'price' => $price,
                'quantity' => $quantity,
            ]);
        }

        // Clear the session cart data
        $this->clearSessionCart();
    }

    public function addToSessionCart($productId, $productName, $price, $quantity = 1)
    {
    	// Retrieve the Session ID
    	$sessionId = Session::getId();

        $cart = Session::get('cart', []);

        $cartItemIndex = collect($cart)->search(function ($item) use ($productName) {
            return is_array($item) && array_key_exists('product_name', $item) && 
            	$item['product_name'] === $productName;
        });

        if ($cartItemIndex !== false) {
            // Update the quantity if the product is already in the cart
            $cart[$cartItemIndex]['quantity'] += $quantity;
        } else {
            // Add the product to the session cart
            $cartItem = [
            	'session_id' => $sessionId,
            	'product_id' => $productId,
                'product_name' => $productName,
                'price' => $price,
                'quantity' => $quantity,
            ];
            $cart[] = $cartItem;
        }

		// Update the session cart data
        Session::put('cart', $cart);
    }

    public function removeFromCart($productId)
    {
        // Remove the product from the user's cart in the database
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->delete();

        // Remove the product from the session cart
        $this->removeFromSessionCart($productId);
    }

    private function removeFromSessionCart($productId)
    {
        $cart = Session::get('cart', []);

        // Remove the product from the session cart based on product ID
        $cart = array_filter($cart, function ($item) use ($productId) {
            return is_array($item) && array_key_exists('product_id', $item) && $item['product_id'] !== $productId;
        });

        // Update the session cart data
        Session::put('cart', $cart);
    }

	public function clearSessionCart()
    {
        Session::forget('cart');
    }
}
