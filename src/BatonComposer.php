<?php

namespace Jshannon63\Baton;

use Illuminate\Contracts\View\View;

class BatonComposer
{

    protected $baton;

    public function __construct(Baton $baton)
    {
        $this->baton = $baton;
    }

    public function compose(View $view)
    {
        $view->with('baton', $this->build_response());
    }

    private function build_response()
    {
        $response = $this->baton->addRoutes()->toJson();
        return <<<EOT
    var baton = JSON.parse('$response');
EOT;

    }

}