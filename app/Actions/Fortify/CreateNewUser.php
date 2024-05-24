<?php

namespace App\Actions\Fortify;

use App\Enum\UserType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        Validator::make($input, [
            'document' => ['required','integer','unique:users','min:0'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type' => ['required', new Enum(UserType::class)],
            'report' => ['required_if:type,discapacitado','file'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],[
            'report.required_if' => 'Porfavor incluya un reporte medico.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.required' => 'Ingrese una contraseña.',
            'password.min' => 'Su contraseña debe tener al menos 8 caracteres.',
            'document.required' => 'El numero de cedula es obligatorio.',
            'document.unique' => 'El numero de ceula ya esta registrado.',
            'name.required' => 'El campo nombre es obligatorio.',
            'type.required' => 'Elija un tipo de persona.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya esta registrado.',
        ])->validate();

        $user = User::create([
            'document' => $input['document'],
            'name' => $input['name'],
            'email' => $input['email'],
            'type' => $input['type'],
            'password' => Hash::make($input['password']),
        ]);

        $user->addMedia($input['report'])
            ->toMediaCollection('medical-report');

        return $user;
    }
}
