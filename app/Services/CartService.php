<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'cart';

    public function add(int $productId, int $quantity = 1): void
    {
        $cart = $this->getCart();
        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
        $this->saveCart($cart);
    }

    public function update(int $productId, int $quantity): void
    {
        $cart = $this->getCart();

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        $this->saveCart($cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        $this->saveCart($cart);
    }

    public function clear(): void
    {
        Session::forget($this->sessionKey);
    }

    public function getCart(): array
    {
        return Session::get($this->sessionKey, []);
    }

    public function getItems(): Collection
    {
        $cart = $this->getCart();

        if (empty($cart)) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        return $products->map(function ($product) use ($cart) {
            $product->cart_quantity = $cart[$product->id];
            $product->subtotal = $product->price * $cart[$product->id];
            return $product;
        });
    }

    public function getTotal(): float
    {
        return $this->getItems()->sum('subtotal');
    }

    public function getCount(): int
    {
        return array_sum($this->getCart());
    }

    protected function saveCart(array $cart): void
    {
        Session::put($this->sessionKey, $cart);
    }
}
