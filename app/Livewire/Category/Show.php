<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.category.show');
    }
}
