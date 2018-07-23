<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Role;

class RolesProvider extends ServiceProvider
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
			$view->with('role_array', Role::all());
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
