<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public Transaction $transaction;


    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.transaction.show');
    }
}
