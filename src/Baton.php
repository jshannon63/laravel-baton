<?php

namespace Jshannon63\Baton;

use Illuminate\Support\Collection;
use Illuminate\Routing\Router;

class Baton extends Collection
{

    private $router;

    public function __construct(Router $router)
    {
        parent::__construct([]);
        $this->router = $router;
    }

    public function addRoutes()
    {
        if (env('BATON_ROUTES', true) && !$this->has('routes')) {
            $this->put('routes',
                collect($this->router->getRoutes()->getRoutesByName())->map(function ($route) {
                    return collect($route)->only(['uri', 'methods']);
                })
            );
        }
        return $this;
    }

}
