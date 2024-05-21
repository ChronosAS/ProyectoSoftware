<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    public function toResponse($request)
    {
        session()->flash('flash.banner','Gracias por Registrarse, porfavor espere a que su cuenta sea aprovada');
        session()->flash('flash.bannerStyle','success');
        return redirect()->route('login');
    }

}
