<?php

namespace interactivesolutions\honeycombmenu\app\http\middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use interactivesolutions\honeycombmenu\app\helpers\MenuHelper;

class HCMenu
{
    public function handle(Request $request, Closure $next)
    {
        $firstSegment = request()->segment(1);
        $menuLists = config('hc.menu');

        $noLanguage = config('hc.noLanguage');
        array_push($noLanguage, config('hc.admin_url'));

        if (!in_array($firstSegment, $noLanguage) && !empty($menuLists)) {
            $mh = new MenuHelper();
            $menu = [];

            foreach ($menuLists as $menuList) {
                $menu[$menuList] = $mh->getMenu($menuList, app()->getLocale());
            }

            View::share("menu", $menu);
        }

        return ($next($request));
    }
}