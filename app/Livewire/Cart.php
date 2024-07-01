<?php

namespace App\Livewire;

use App\Facades\CartFacade;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $total_price;

    public function mount()
    {
        $this->cart = CartFacade::get();
        $this->getTotal();
    }

    public function getTotal()
    {
        $this->total_price = array_sum(array_column($this->cart['articles'],'total_price'));
    }

    public function emptyCart()
    {
        CartFacade::clear();
        $this->cart = CartFacade::get();
        $this->getTotal();
    }

    public function removeFromCart($articleId)
    {
        CartFacade::remove($articleId);
        $this->cart = CartFacade::get();
        $this->getTotal();
    }

    public function addOneToCart($articleId)
    {
        CartFacade::addOne($articleId);
        $this->cart = CartFacade::get();
        $this->getTotal();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.cart');
    }
}
