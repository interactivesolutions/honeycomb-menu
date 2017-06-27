<?php

namespace interactivesolutions\honeycombmenu\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombmenu\app\models\HCMenu;
use interactivesolutions\honeycombmenu\app\validators\MenuValidator;

class MenuController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'       => trans('HCMenu::menu.page_title'),
            'listURL'     => route('admin.api.routes.menu'),
            'newFormUrl'  => route('admin.api.form-manager', ['menu-new']),
            'editFormUrl' => route('admin.api.form-manager', ['menu-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_menu_routes_menu_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_menu_routes_menu_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_menu_routes_menu_delete') )
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters();

        return hcview('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'parent_id'    => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.parent_id'),
            ],
            'menu_type_id' => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.menu_type_id'),
            ],
            'type'         => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.type'),
            ],
            'dropdown'     => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.dropdown'),
            ],
            'icon'         => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.icon'),
            ],
            'url'          => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.url'),
            ],
            'link_text'    => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.link_text'),
            ],
            'page_id'      => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.page_id'),
            ],
            'sequence'     => [
                "type"  => "text",
                "label" => trans('HCMenu::menu.sequence'),
            ],

        ];
    }

    /**
     * Create item
     *
     * @return mixed
     */
    protected function __apiStore()
    {
        $data = $this->getInputData();

        $record = HCMenu::create(array_get($data, 'record'));

        $record->menu_groups()->sync(array_get($data, 'menu_groups'));

        $this->forgetMenuCache($record);

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate(string $id)
    {
        $record = HCMenu::findOrFail($id);

        $data = $this->getInputData();

        $this->forgetMenuCache($record);

        $record->update(array_get($data, 'record', []));
        $record->menu_groups()->sync(array_get($data, 'menu_groups'));

        $this->forgetMenuCache($record);

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        HCMenu::where('id', $id)->update(request()->all());

        return $this->apiShow($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiDestroy(array $list)
    {
        HCMenu::destroy($list);

        return hcSuccess();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete(array $list)
    {
        HCMenu::onlyTrashed()->whereIn('id', $list)->forceDelete();

        return hcSuccess();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore(array $list)
    {
        HCMenu::whereIn('id', $list)->restore();

        return hcSuccess();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery(array $select = null)
    {
        $with = ['language' => function ($query) {
            $query->select('id', 'iso_639_1');
        }, 'parent'         => function ($query) {
            $query->select(HCMenu::getFillableFields());
        }
//        , 'page'           => function ($query) {
//            $query->select('id', 'title');
//        }
            ,
         'menu_type'      => function ($query) {
            $query->select('id');
        }];

        if( $select == null )
            $select = HCMenu::getFillableFields();

        $list = HCMenu::with($with)->select($select)
            // add filters
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->search($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery(Builder $query, string $phrase)
    {
        return $query->where(function (Builder $query) use ($phrase) {
            $query->where('parent_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('menu_type_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('type', 'LIKE', '%' . $phrase . '%')
                ->orWhere('dropdown', 'LIKE', '%' . $phrase . '%')
                ->orWhere('icon', 'LIKE', '%' . $phrase . '%')
                ->orWhere('url', 'LIKE', '%' . $phrase . '%')
                ->orWhere('link_text', 'LIKE', '%' . $phrase . '%')
                ->orWhere('page_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('sequence', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new MenuValidator())->validateForm();

        $_data = request()->all();

        array_set($data, 'record.language_code', array_get($_data, 'language'));
        array_set($data, 'record.parent_id', array_get($_data, 'parent'));
        array_set($data, 'record.menu_id', array_get($_data, 'menu_type'));
        array_set($data, 'record.type', array_get($_data, 'type'));
        array_set($data, 'record.url', array_get($_data, 'url'));
        array_set($data, 'record.link_text', array_get($_data, 'link_text'));
        array_set($data, 'record.page_id', array_get($_data, 'page'));

        array_set($data, 'record.icon', array_get($_data, 'icon'));
        array_set($data, 'record.dropdown', array_get($_data, 'dropdown', "0"));
        array_set($data, 'record.sequence', array_get($_data, 'sequence'));

        array_set($data, 'menu_groups', array_get($_data, 'menu_groups', []));

        return $data;
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow(string $id)
    {
        $with = ['parent',
//            'page',
            'menu_groups' => function ($query) {
            $query->select('id', 'name');
        }];

        HCMenu::$customAppends = ['item_label'];

        $select = HCMenu::getFillableFields();
        $select[] = 'language_code as language';
        $select[] = 'menu_type_id as menu_type';

        $record = HCMenu::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        return $filters;
    }


    /**
     * @param $item
     */
    protected function forgetMenuCache($item)
    {
//        MenuHelper::clearCache($item->menu_id, $item->language_id);
    }

    public function pagesSearch()
    {
        if( ! request()->has('q') )
            return [];

        $parameter = request()->input('q');

        if( request()->has('language') && request()->has('menu_type') ) {
            HCMenu::$customAppends = ['item_label'];

            return HCMenu::select(HCMenu::getFillableFields())
                ->where(function ($query) {
                    $query->where('language_id', request()->input('language'))
                        ->where('menu_id', request()->input('menu_type'));
                })
                ->where(function ($query) use ($parameter) {
                    $query->where('link_text', 'LIKE', '%' . $parameter . '%')
                        ->orWhereHas('page.content', function ($query) use ($parameter) {

                            $query->where('language_code', request()->input('language'))
                                ->where('title', 'LIKE', '%' . $parameter . '%');
                        });
                })
                ->get();
        }

        $list = HCMenu::select("id", "link_text")
            ->orWhere('link_text', 'LIKE', '%' . $parameter . '%')
            ->orWhereHas('page.content', function ($query) use ($parameter) {

                $query->where('language_code', request()->input('language'))
                    ->where('title', 'LIKE', '%' . $parameter . '%');
            })
            ->take(50)
            ->get();

        return $list;
    }
}
