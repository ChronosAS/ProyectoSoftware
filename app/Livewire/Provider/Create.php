<?php

namespace App\Livewire\Provider;

use App\Models\Provider;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ],[
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre sobrepasa el maximo de caracteres.',
            'email.max' => 'El campo email sobrepasa el maximo de caracteres.',
            'email.unique' => 'El correo electrónico ya esta registrado.',
            'email.email' => 'Ingrese un correo valido.',
        ]);

        Provider::create([
            'name' => $this->name,
            'email'=> $this->email
        ]);


        session()->flash('flash.banner','Proveedor creado con exito.');
        session()->flash('flash.bannerStyle','success');

        return redirect()->route('providers.index');

    }

    #[Layout('layouts.app',['header'=>'Crear Proveedor'])]
    public function render()
    {
        return view('livewire.provider.create');
    }
}
