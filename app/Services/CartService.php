<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getCart()
    {
        return Session::get('cart', []);
    }

    public function addToCart($productName, $price, $quantity = 1)
    {
        $cart = Session::get('cart', []);

        $cartItemIndex = collect($cart)->search(function ($item) use ($productName) {
            return is_array($item) && array_key_exists('product_name', $item) && $item['product_name'] === $productName;
        });

        if ($cartItemIndex !== false) {
            // Update the quantity if the product is already in the cart
            $cart[$cartItemIndex]['quantity'] += $quantity;
        } else {
            // Add the product to the cart
            $cartItem = [
                'product_name' => $productName,
                'price' => $price,
                'quantity' => $quantity,
            ];
            $cart[] = $cartItem;
        }

        Session::put('cart', $cart);
    }

    public function removeFromCart($productName)
    {
        $cart = Session::get('cart', []);

        $cart = array_values(array_filter($cart, function ($item) use ($productName) {
            return $item['product_name'] !== $productName;
        }));

        Session::put('cart', $cart);
    }

	public function clearCart()
    {
        Session::forget('cart');
    }
}
