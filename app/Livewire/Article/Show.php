<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public Article $article;
    public $image;

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->image = $article->getFirstMedia('article-image');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.article.show');
    }
}
