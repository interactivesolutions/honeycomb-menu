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
        $menuList = config('hc.menu');

        $noLanguage = config('hc.noLanguage');
        array_push($noLanguage, config('hc.admin_url'));

        if (!in_array($firstSegment, $noLanguage) && !empty($menuList)) {
            $mh = new MenuHelper();
            $menu = [];

            foreach ($menuList as $key => $menuID) {
                $menu[$key] = $mh->getMenu($menuID, app()->getLocale());
            }

            View::share("menu", $menu);
        }

        return ($next($request));
    }
}