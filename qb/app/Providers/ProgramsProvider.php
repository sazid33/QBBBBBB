<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Program;

class ProgramsProvider extends ServiceProvider
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
			$view->with('programs_array', Program::all());
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
