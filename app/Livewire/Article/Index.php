<?php

namespace App\Livewire\Article;

use App\Concerns\LivewireCustomPagination;
use App\Models\Article;
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

    public function delete($article)
    {
        $article = Article::withTrashed()->find($article);
        $article->categories()->detach($article->categories->pluck('id')->toArray());
        $article->providers()->detach($article->providers->pluck('id')->toArray());
        $article->forceDelete();
    }

    private function loadArticles(){
        return Article::query()
            ->select([
                'id',
                'name',
                'description',
                'price',
                'stock',
            ])
            ->withAggregate('providers','name')
            ->withAggregate('providers','email')
            ->search($this->search)
            ->orderBy($this->sortField ?? 'id', $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->perPage);
    }

    #[Layout('layouts.app',['header'=>'Articulos'])]
    public function render()
    {
        return view('livewire.article.index',[
            'articles' => $this->loadArticles(),
        ]);
    }
}
