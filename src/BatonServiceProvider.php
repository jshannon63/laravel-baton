<?php

namespace Jshannon63\Baton;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\Factory as ViewFactory;

class BatonServiceProvider extends ServiceProvider
{

    public function boot(ViewFactory $view)
    {
        $view->composer('*', 'Jshannon63\Baton\BatonComposer');
    }


    public function register()
    {
        $this->app->singleton('Jshannon63\Baton\Baton');
    }
}
