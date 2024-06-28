<?php

namespace App\Livewire;

use App\Concerns\LivewireCustomPagination;
use App\Facades\CartFacade as Cart;
use App\Models\Article;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Catalog extends Component
{

    use LivewireCustomPagination;

    public $sortField = null;

    protected $queryString = [
        'sortField' => ['except'=>''],
        'perPage' => ['except'=>10],
        'sortAsc' => ['except'=>false]
    ];

    private function loadArticles()
    {
        return Article::query()
            ->select([
                'id',
                'name',
                'description',
                'price',
                'stock',
            ])
            ->where('stock','>',0)
            ->withAggregate('categories','name')
            ->withAggregate('providers','name')
            ->withAggregate('providers','email')
            ->search($this->search)
            ->orderBy($this->sortField ?? 'id', $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->perPage);
    }

    public function addToCart(string $productId): void
    {
        Cart::add(Article::where('id', $productId)->first());
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.catalog',[
            'articles' => $this->loadArticles()
        ]);
    }
}
