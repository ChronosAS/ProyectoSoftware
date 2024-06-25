<?php

namespace App\Livewire\Provider;

use App\Models\Provider;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public Provider $provider;

    public $name;
    public $email;

    public function mount(Provider $provider)
    {
        $this->provider = $provider;

        $this->fill(
            $provider->only('name','email'),
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

        $this->provider->update([
            'name' => $this->name,
            'email'=> $this->email
        ]);


        session()->flash('flash.banner','Proveedor actualizado con exito.');
        session()->flash('flash.bannerStyle','success');

        return redirect()->route('providers.index');

    }

    #[Layout('layouts.app',['header'=>'Editar Proveedor'])]
    public function render()
    {
        return view('livewire.provider.edit');
    }
}
