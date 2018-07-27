<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Subject;

class SubjectProvider extends ServiceProvider
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
			$view->with('subject_array', Subject::all());
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
