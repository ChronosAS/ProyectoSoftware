<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public Category $category;

    public $name;
    public $email;

    public function mount(Category $category)
    {
        $this->category = $category;

        $this->fill(
            $category->only('name'),
        );
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ],[
            'name.required' => 'El campo nombre es obligatorio.',
            'email.unique' => 'El correo electrónico ya esta registrado.',
        ]);

        $this->category->update([
            'name' => $this->name,
        ]);


        session()->flash('flash.banner','Proveedor actualizado con exito.');
        session()->flash('flash.bannerStyle','success');

        return redirect()->route('categories.index');

    }

    #[Layout('layouts.app',['header'=>'Editar Categoria'])]
    public function render()
    {
        return view('livewire.category.edit');
    }
}
