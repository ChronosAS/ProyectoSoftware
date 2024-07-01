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

        if ($cart['articles'][$article->id]??false) {

            $cart['articles'][$article->id]['quantity']+=$quantity;
            $cart['articles'][$article->id]['total_price'] = $this->getTotalPrice($cart,$article->id);

        } else {
            $cart['articles'][$article->id] = [
                'article' => $article,
                'quantity' => $quantity,
                'total_price' => $article->price*$quantity
            ];
        }

        $this->set($cart);
    }

    public function removeOne(string $articleId): void
    {
        $cart = $this->get();
        $cart['articles'][$articleId]['quantity']--;
        $cart['articles'][$articleId]['total_price'] = $this->getTotalPrice($cart,$articleId);
        $this->set($cart);
    }

    public function getTotalPrice(array $cart,string $id)
    {
        return $cart['articles'][$id]['quantity']*$cart['articles'][$id]['article']->price;
    }

    public function addOne(string $articleId): void
    {
        $cart = $this->get();
        $cart['articles'][$articleId]['quantity']++;
        $cart['articles'][$articleId]['total_price'] = $this->getTotalPrice($cart,$articleId);
        $this->set($cart);
    }

    // public function search(string $articleId)
    // {
    //     return array_search($articleId,array_column(array_column(Cart::get()['articles'],'article'),'id'));
    // }

    public function removeAll(string $articleId): void
    {
        $cart = $this->get();
        unset($cart['articles'][$articleId]);
        $this->set($cart);
    }

    public function remove(string $articleId): void
    {
        $cart = $this->get();
        if($cart['articles'][$articleId]['quantity'] == 1){
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
