<?php

namespace interactivesolutions\honeycombmenu\app\helpers;

use Cache;
use interactivesolutions\honeycombmenu\app\models\HCMenu;
use interactivesolutions\honeycombmenu\app\models\menu\HCMenuGroups;
use interactivesolutions\honeycombpages\app\models\HCPages;

class MenuHelper
{
    /**
     * Menu model class namespace
     *
     * @var string
     */
    protected $menuClass = HCMenu::class;

    /**
     * Pages model class namespace
     *
     * @var string
     */
    protected $pagesClass = HCPages::class;

    /**
     * Menu groups model class namespace
     *
     * @var string
     */
    protected $menuGroupsClass = HCMenuGroups::class;

    /**
     * Menu select items
     *
     * @var array
     */
    protected $selectFields = ['dropdown', 'icon', 'item_label', 'item_url', 'sequence'];

    /**
     * By default cache is enabled
     *
     * @var bool
     */
    protected $cacheEnabled = true;

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
        if( is_null($language) ) {
            $language = app()->getLocale();
        }

        if( $this->cacheEnabled ) {
            $cacheName = self::getCacheName($menuTypeId, $language);

            if( Cache::has($cacheName) ) {
                return Cache::get($cacheName);
            }
        }

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
        $this->menuClass::$menuTypeId = $menuTypeId;
        $this->menuClass::$customAppends = ['item_url', 'item_label'];
        $this->pagesClass::$customAppends = ['page_url'];

        $items = $this->menuClass::with(['children' => function ($query) use ($menuTypeId, $language) {
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

        if( $this->cacheEnabled ) {
            Cache::put(self::getCacheName($menuTypeId, $language), $menu, $this->cacheTime);
        }

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
                $itemData['children'] = $this->sortByField(
                    $this->formatMenuItems($item->children)
                );
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

        $this->menuClass::$customAppends = ['item_url', 'item_label'];
        $this->pagesClass::$customAppends = ['page_url'];

        $items = $this->menuGroupsClass::select('id', 'name', 'sequence')
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

    /**
     * Set menu model class namespace
     *
     * @param string $menuClass
     * @return $this
     */
    public function setMenuClass(string $menuClass)
    {
        $this->menuClass = $menuClass;

        return $this;
    }

    /**
     * Set menu group model class namespace
     *
     * @param string $menuGroupsClass
     * @return $this
     */
    public function setMenuGroupsClass(string $menuGroupsClass)
    {
        $this->menuGroupsClass = $menuGroupsClass;

        return $this;
    }

    /**
     * Set pages model class namespace
     *
     * @param string $pagesClass
     * @return $this
     */
    public function setPagesClass(string $pagesClass)
    {
        $this->pagesClass = $pagesClass;

        return $this;
    }

    /**
     * Set cache time in seconds
     *
     * @param int $cacheTime
     * @return $this
     */
    public function setCacheTime(int $cacheTime)
    {
        $this->cacheTime = $cacheTime;

        return $this;
    }

    /**
     * Sort descending order or not
     *
     * @param bool $sortDesc
     * @return $this
     */
    public function setSortDesc(bool $sortDesc)
    {
        $this->sortDesc = $sortDesc;

        return $this;
    }

    /**
     * Set sort field
     *
     * @param string $sortBy
     * @return $this
     */
    public function sortByKey(string $sortBy)
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    /**
     * You can enable or disable cache
     *
     * @return $this
     */
    public function noCache()
    {
        $this->cacheEnabled = false;

        return $this;
    }
}