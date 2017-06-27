<?php

namespace interactivesolutions\honeycombmenu\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCMenuServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombmenu\app\http\controllers';

    public $serviceProviderNameSpace = 'HCMenu';
}





