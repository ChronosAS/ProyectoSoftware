<?php

namespace App\Livewire;

use App\Concerns\LivewireCustomPagination;
use App\Facades\CartFacade as Cart;
use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Catalog extends Component
{

    use LivewireCustomPagination;

    public $sortField = null;
    public $category = [];
    public $cart;

    protected $queryString = [
        'sortField' => ['except'=>''],
        'perPage' => ['except'=>10],
        'sortAsc' => ['except'=>false]
    ];

    public function mount(): void
    {
        $this->cart = Cart::get();
    }

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
            ->when($this->category, function ($query){
                return $query->whereHas('categories', function($q){
                    $q->whereIn('category_id',$this->category);
                });
            })
            ->search($this->search)
            ->orderBy($this->sortField ?? 'id', $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->perPage);
    }

    public function addToCart(string $articleId): void
    {
        $key = array_search($articleId,array_column(array_column(Cart::get()['articles'],'article'),'id'));

        Cart::add(Article::where('id', $articleId)->first(),$key,1);
    }

    #[Layout('layouts.app',['header' => 'Productos'])]
    public function render()
    {
        return view('livewire.catalog',[
            'articles' => $this->loadArticles(),
            'all_categories' => Category::all()
        ]);
    }
}
