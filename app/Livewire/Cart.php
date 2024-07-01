<?php

namespace App\Livewire;

use App\Facades\CartFacade;
use App\Models\Article;
use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Cart extends Component
{
    public $cart;
    #[Locked]
    public $articles;
    public $total_price;

    public function mount()
    {
        $this->cart = CartFacade::get();
        $this->getTotal();
        $this->articles = Article::findMany(array_keys($this->cart['articles']))->append('available')->keyBy('id');
    }

    public function getTotal()
    {
        $this->total_price = array_sum(array_column($this->cart['articles'],'total_price'));
    }

    public function checkout()
    {

        tap(Transaction::create([
            'user_id' => auth()->user()->id,
            'total_price' => $this->total_price,
        ]),function($transaction){
            foreach($this->cart['articles'] as $article){
                $article['article']->update(['stock'=> $article['article']->available]);
                $transaction->articles()->attach($article['article']->id,['total_price'=>$article['total_price'],'quantity'=>$article['quantity']]);
            }
            session()->flash('flash.banner','Transaccion creado con exito. Proceda a verificar su pago');
            session()->flash('flash.bannerStyle','success');

            $this->emptyCart();
            return redirect()->route('transaction.show',$transaction->id);
        });


    }

    public function emptyCart()
    {
        CartFacade::clear();
        $this->cart = CartFacade::get();
        $this->getTotal();
    }

    public function removeOneFromCart($articleId)
    {
        CartFacade::remove($articleId);
        $this->cart = CartFacade::get();
        $this->getTotal();
    }

    public function removeAllFromCart($articleId)
    {
        $this->cart = CartFacade::get();
        CartFacade::removeAll($articleId);
        $this->cart = CartFacade::get();
        $this->getTotal();
    }

    public function addOneToCart($articleId)
    {
        CartFacade::addOne($articleId);
        $this->cart = CartFacade::get();
        $this->getTotal();
    }

    #[Layout('layouts.app',['header'=>'Carrito de compras'])]
    public function render()
    {
        return view('livewire.cart');
    }
}
