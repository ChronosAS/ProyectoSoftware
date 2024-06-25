<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public $name;

    public function save()
    {
        $this->validate([
            'name' => ['required','max:200']
        ],[
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre esta por ensima de el limite de caracteres.',
        ]);

        Category::create(['name'=>$this->name]);

        session()->flash('flash.banner','Categoria creado con exito.');
        session()->flash('flash.bannerStyle','success');

        return redirect()->route('categories.index');
    }

    #[Layout('layouts.app',['header'=>'Crear Categoria'])]
    public function render()
    {
        return view('livewire.category.create');
    }
}
