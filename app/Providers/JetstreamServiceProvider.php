<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Enum\UserType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Fortify::authenticateUsing(function(Request $request){
            $user = User::where('email', $request->email)->first();

            if($user &&
                Hash::check($request->password, $user->password)) {
                    if($user->accepted)
                    {
                        return $user;
                    }

                    throw ValidationException::withMessages([
                        Fortify::username() => ['Parece que su cuenta aun no ha sido aprobada.'],
                    ]);

                    // session()->flash('flash.banner','Parece que su cuenta aun no ha sido aprobada');
                    // session()->flash('flash.bannerStyle','warning');
                }
        });
        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::registerView(function() {
            return view('auth.register')->with('user_types',UserType::cases());
        });

        $this->app->singleton(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
                    \App\Http\Responses\RegisterResponse::class);
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
