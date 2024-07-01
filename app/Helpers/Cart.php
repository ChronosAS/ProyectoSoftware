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
                'quantity' => $quantity,
                'total_price' => $article->price*$quantity
            ];

            array_push($cart['articles'], $new_article);

        } else {

            $cart['articles'][$key]['quantity']+=$quantity;
            $cart['articles'][$key]['total_price'] = $this->getTotalPrice($cart,$key);
        }

        $this->set($cart);
    }

    public function removeOne(string $articleId): void
    {
        $cart = $this->get();
        $key = $this->search($articleId);
        $cart['articles'][$key]['quantity']--;
        $cart['articles'][$key]['total_price'] = $this->getTotalPrice($cart,$key);
        $this->set($cart);
    }

    public function getTotalPrice(array $cart,int $key)
    {
        return $cart['articles'][$key]['quantity']*$cart['articles'][$key]['article']->price;
    }

    public function addOne(string $articleId): void
    {
        $cart = $this->get();
        $key = $this->search($articleId);
        $cart['articles'][$key]['quantity']++;
        $cart['articles'][$key]['total_price'] = $this->getTotalPrice($cart,$key);
        $this->set($cart);
    }

    public function search(string $articleId)
    {
        return array_search($articleId,array_column(array_column(Cart::get()['articles'],'article'),'id'));
    }

    public function removeAll(string $articleId): void
    {
        $cart = $this->get();
        array_splice($cart['articles'],$this->search($articleId), 1);
        $this->set($cart);
    }

    public function remove(string $articleId): void
    {
        $cart = $this->get();
        if($cart['articles'][$this->search($articleId)]['quantity'] == 1){
            $this->removeAll($articleId);
        }else{
            $this->removeOne($articleId);
        }

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
