<?php

namespace App\Helpers;

use App\Models\Article;

class Cart
{
    public function __construct()
    {
        if($this->get() === null)
            $this->set($this->empty());
    }

    public function add(Article $article): void
    {
        $cart = $this->get();
        array_push($cart['articles'], $article);
        $this->set($cart);
    }

    public function remove(string $articleId): void
    {
        $cart = $this->get();
        array_splice($cart['articles'], array_search($articleId, array_column($cart['articles'], 'id')), 1);
        $this->set($cart);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'articles' => [],
        ];
    }

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    private function set($cart): void
    {
        request()->session()->put('cart', $cart);
    }
}
