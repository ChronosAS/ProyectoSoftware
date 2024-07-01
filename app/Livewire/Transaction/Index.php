<?php

namespace App\Livewire\Transaction;

use App\Concerns\LivewireCustomPagination;
use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    use LivewireCustomPagination;

    public $sortField = null;

    protected $queryString = [
        'sortField' => ['except'=>''],
        'perPage' => ['except'=>10],
        'sortAsc' => ['except'=>false]
    ];

    private function loadTransactions(){
        return Transaction::query()
            ->select([
                'id',
                'code',
                'user_id',
                'total_price',
                'payment_ref',
                'status',
            ])
            ->withAggregate('user','name')
            ->search($this->search)
            ->orderBy($this->sortField ?? 'id', $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->perPage);
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.transaction.index',[
            'transactions' => $this->loadTransactions()
        ]);
    }
}
