<?php

namespace App\Providers;

use App\Chapter;
use Illuminate\Support\ServiceProvider;

class ChapterProvider extends ServiceProvider
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
			$view->with('chapter_array', Chapter::all());
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
