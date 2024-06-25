<?php

namespace App\Livewire\Article;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $description;
    public $price;
    public $stock;
    public $image;
    public $categories = [];

    public function save()
    {

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.article.create',[
            'all_categories' => Category::all()
        ]);
    }
}
