<?php

namespace App\Livewire\Provider;

use App\Concerns\LivewireCustomPagination;
use App\Models\Provider;
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

    private function loadProviders(){
        return Provider::query()
            ->select([
                'id',
                'name',
                'email',
            ])
            ->search($this->search)
            ->orderBy($this->sortField ?? 'id', $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->perPage);
    }

    #[Layout('layouts.app',['header'=>'Proveedores'])]
    public function render()
    {
        return view('livewire.provider.index',[
            'providers' => $this->loadProviders(),
        ]);
    }
}
