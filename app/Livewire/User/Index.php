<?php

namespace App\Livewire\User;

use App\Concerns\LivewireCustomPagination;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    use LivewireCustomPagination;

    public $sortField = null;

    public $type = null;
    public $is_active = null;

    protected $queryString = [
        'sortField' => ['except'=>''],
        'perPage' => ['except'=>10],
        'sortAsc' => ['except'=>false]
    ];

    private function loadUsers(){
        return User::query()
            ->select([
                'id',
                'document',
                'name',
                'email',
                'type',
                'accepted'
            ])
            ->when($this->type, function ($query){
                return $query->where('type', $this->type);
            })
            ->when(strlen($this->is_active)>0, function($query){
                return $query->where('accepted', $this->is_active);
            })
            ->search($this->search)
            ->orderBy($this->sortField ?? 'id', $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.user.index',[
            'users' => $this->loadUsers(),
            'statuses' => [1 => 'Active',0 => 'Inactive'],
        ])->layout('layouts.app',['header'=>'Usuarios']);
    }
}
