<?php

namespace App\Livewire\User;

use App\Enum\UserType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $document;
    public $type;
    public $name;
    public $email;
    public $password;
    public $report;

    public function save()
    {

        $this->validate([
            'document' => ['required','integer','unique:users','min:0'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type' => ['required', new Enum(UserType::class)],
            'report' => ['required_if:type,discapacitado'],
            'password' => ['required', 'string', Password::default()]
        ],[
            'report.required_if' => 'Porfavor incluya un reporte medico.',
            'password.required' => 'Ingrese una contraseña.',
            'password.min' => 'Su contraseña debe tener al menos 8 caracteres.',
            'document.required' => 'El numero de cedula es obligatorio.',
            'document.unique' => 'El numero de cedula ya esta registrado.',
            'name.required' => 'El campo nombre es obligatorio.',
            'type.required' => 'Elija un tipo de persona.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya esta registrado.',
        ]);

        tap(User::create([
            'document' => $this->document,
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'password' => Hash::make($this->password),
        ]),function($user){
            if($this->report){
                $user->addMedia($this->report)
                ->toMediaCollection('medical-report');
            }
        });

        session()->flash('flash.banner','Usuario creado con exito.');
        session()->flash('flash.bannerStyle','success');

        return redirect()->route('users.index');

    }

    #[Layout('layouts.app',['header' => 'Crear Usuario'])]
    public function render()
    {
        return view('livewire.user.create',[
            'user_types' => UserType::cases()
        ]);
    }
}
