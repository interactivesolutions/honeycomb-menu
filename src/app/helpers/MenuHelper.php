<?php

namespace interactivesolutions\honeycombmenu\app\helpers;

use Cache;
use interactivesolutions\honeycombmenu\app\models\HCMenu;
use interactivesolutions\honeycombmenu\app\models\menu\HCMenuGroups;
use interactivesolutions\honeycombpages\app\models\HCPages;

class MenuHelper
{
    /**
     * Menu select items
     *
     * @var array
     */
    protected $selectFields = ['dropdown', 'icon', 'item_label', 'item_url', 'sequence'];

    /**
     * Sort by field
     *
     * @var string
     */
    protected $sortBy = 'sequence';

    /**
     * Sort descending
     *
     * @var bool
     */
    protected $sortDesc = false;

    /**
     * Menu cache time for 24h
     *
     * @var int
     */
    protected $cacheTime = 1140;

    /**
     * Get menu cache name
     *
     * @param $menuTypeId
     * @param $languageCode - language_code_iso639_1
     * @return string
     */
    public static function getCacheName($menuTypeId, $languageCode)
    {
        $cacheName = 'menu.' . $menuTypeId . '_' . $languageCode;

        return $cacheName;
    }

    /**
     * Get cached menu or cache it
     *
     * @param $menuTypeId
     * @param null $language
     * @return mixed
     */
    public function getMenu($menuTypeId, $language = null)
    {
        if( is_null($language) )
            $language = app()->getLocale();

        $cacheName = self::getCacheName($menuTypeId, $language);

        if( Cache::has($cacheName) )
            return Cache::get($cacheName);

        return $this->getMenuItems($menuTypeId, $language);
    }

    /**
     * Get menu items
     *
     * @param $menuTypeId
     * @param $language
     * @return mixed
     */
    protected function getMenuItems($menuTypeId, $language)
    {
        HCMenu::$menuTypeId = $menuTypeId;
        HCMenu::$customAppends = ['item_url', 'item_label'];
        HCPages::$customAppends = ['page_url'];

        $items = HCMenu::with(['children' => function ($query) use ($menuTypeId, $language) {
            $query->with('children')
                ->where('menu_type_id', $menuTypeId)
                ->where('language_code', $language);
        }])
            ->where('menu_type_id', $menuTypeId)
            ->where('language_code', $language)
            ->whereNull('parent_id')
            ->get();

        if( $items->isEmpty() ) {
            return [];
        }

        $menu = $this->formatMenuItems($items)->filter(function ($item, $key) {
            return ($item['item_url'] != "" && $item['item_label'] != "");
        })->values()->toArray();

        \Cache::put(self::getCacheName($menuTypeId, $language), $menu, $this->cacheTime);

        return $menu;
    }

    /**
     * Format menu items
     *
     * @param $items
     * @return mixed
     */
    protected function formatMenuItems(&$items)
    {
        foreach ( $items as $key => $item ) {
            $itemData = array_only($item->toArray(), $this->selectFields);

            if( ! $item->children->isEmpty() ) {
                $itemData['children'] = $this->sortByField($this->formatMenuItems($item->children));
            }

            $items[$key] = $itemData;
        }

        return $items;
    }

    /**
     * @param $items
     * @return array
     */
    protected function sortByField($items)
    {
        return collect($items)
            ->sortBy($this->sortBy, SORT_REGULAR, $this->sortDesc)
            ->values()
            ->toArray();
    }

    /**
     * Get menu by groups
     *
     * @param null $language
     * @return mixed
     */
    public function getMenuByGroup($language = null)
    {
        if( is_null($language) )
            $language = app()->getLocale();

        HCMenu::$customAppends = ['item_url', 'item_label'];
        HCPages::$customAppends = ['page_url'];

        $items = HCMenuGroups::select('id', 'name', 'sequence')
            ->with(['menu_items' => function ($query) use ($language) {
                $query->where('language_code', $language);
            }])
            ->where('language_code', $language)
            ->active()
            ->orderBy('sequence', 'ASC')
            ->get();

        foreach ( $items as $key => $item ) {
            $items[$key]['menu_items'] = $this->formatMenuItems($item->menu_items);
        }

        return $items;
    }

    /**
     * Clear menu item cache
     *
     * @param $menuTypeId
     * @param $lang
     */
    public static function clearCache($menuTypeId, $lang)
    {
        $name = self::getCacheName($menuTypeId, $lang);

        Cache::forget($name);
    }
}