<?php

namespace interactivesolutions\honeycombmenu\app\providers;

use Illuminate\Routing\Router;
use InteractiveSolutions\HoneycombCore\Providers\HCBaseServiceProvider;
use interactivesolutions\honeycombmenu\app\http\middleware\HCMenu;

class HCMenuServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombmenu\app\http\controllers';

    public $serviceProviderNameSpace = 'HCMenu';

    public function registerMiddleWare(Router $router)
    {
        $router->pushMiddleWareToGroup('web', HCMenu::class);
    }
}





