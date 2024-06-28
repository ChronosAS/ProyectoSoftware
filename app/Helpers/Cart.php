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

    public function add(Article $article,$key,$quantity): void
    {
        $cart = $this->get();

        if ($key === false) {

            $new_article = [
                'article' => $article,
                'quantity' => $quantity
            ];

            array_push($cart['articles'], $new_article);

        } else {

            $cart['articles'][$key]['quantity']+=$quantity;
        }

        $this->set($cart);
    }

    public function removeOne(string $articleId): void
    {
        $cart = $this->get();
        $cart['articles'][array_search($articleId,array_column(array_column(Cart::get()['articles'],'article'),'id'))]['quantity']--;
        $this->set($cart);
    }

    public function addOne(string $articleId): void
    {
        $cart = $this->get();
        $cart['articles'][array_search($articleId,array_column(array_column(Cart::get()['articles'],'article'),'id'))]['quantity']++;
        $this->set($cart);
    }

    public function removeAll(string $articleId): void
    {
        $cart = $this->get();
        array_splice($cart['articles'], array_search($articleId,array_column(array_column(Cart::get()['articles'],'article'),'id')), 1);
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
