<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function toResponse($request)
    {
        if(!User::findOrFail(auth()->user()->id)->accepted)
        {
            $this->guard->logout();
        }

        return redirect()->intended(config('fortify.home'));
    }

}
