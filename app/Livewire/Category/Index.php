<?php

namespace App\Livewire\Category;

use App\Concerns\LivewireCustomPagination;
use App\Models\Category;
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

    public function delete($category)
    {
        $category = Category::withTrashed()->find($category);
        $category->articles()->detach($category->articles->pluck('id')->toArray());
        $category->forceDelete();
    }

    private function loadCategories(){
        return Category::query()
            ->select([
                'id',
                'name',
            ])
            ->search($this->search)
            ->orderBy($this->sortField ?? 'id', $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->perPage);
    }

    #[Layout('layouts.app',['header'=>'Categorias'])]
    public function render()
    {
        return view('livewire.category.index',[
            'categories'=>$this->loadCategories()
        ]);
    }
}
