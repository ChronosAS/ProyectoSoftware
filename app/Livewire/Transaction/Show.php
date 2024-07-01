<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public Transaction $transaction;
    public $payment_ref;

    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function save()
    {
        $this->transaction->update(['payment_ref'=>$this->payment_ref]);

        session()->flash('flash.banner','Referencia agregada con exito.');
        session()->flash('flash.bannerStyle','success');

        return redirect()->back();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.transaction.show');
    }
}
