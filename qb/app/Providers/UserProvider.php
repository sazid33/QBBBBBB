<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;

class UserProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('*',function($view){
			$view->with('user_array', User::all());
		});
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
