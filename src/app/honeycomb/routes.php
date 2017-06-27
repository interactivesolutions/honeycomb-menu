<?php

//src/app/routes//admin/01_routes.menu.types.php


Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('menu-types', ['as' => 'admin.routes.menu.types.index', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'MenuTypesController@adminIndex']);

    Route::group(['prefix' => 'api/menu-types'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.menu.types', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'MenuTypesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_create'], 'uses' => 'MenuTypesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'MenuTypesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.menu.types.list', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'MenuTypesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.menu.types.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'MenuTypesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.menu.types.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_create', 'acl:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'MenuTypesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.menu.types.force', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_force_delete'], 'uses' => 'MenuTypesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.menu.types.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'MenuTypesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'MenuTypesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'MenuTypesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.menu.types.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'MenuTypesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.menu.types.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list', 'acl:interactivesolutions_honeycomb_menu_routes_menu_types_create'], 'uses' => 'MenuTypesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.menu.types.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_force_delete'], 'uses' => 'MenuTypesController@apiForceDelete']);
        });
    });
});


//src/app/routes//admin/02_routes.menu.php


Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('menu', ['as' => 'admin.routes.menu.index', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@adminIndex']);

    Route::group(['prefix' => 'api/menu'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.menu', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_create'], 'uses' => 'MenuController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_delete'], 'uses' => 'MenuController@apiDestroy']);

        Route::get('pages/search', ['as' => 'admin.api.routes.menu.pages.search', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@pagesSearch']);
        Route::get('list', ['as' => 'admin.api.routes.menu.list', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.menu.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_update'], 'uses' => 'MenuController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.menu.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_create', 'acl:interactivesolutions_honeycomb_menu_routes_menu_delete'], 'uses' => 'MenuController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.menu.force', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_force_delete'], 'uses' => 'MenuController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.menu.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_update'], 'uses' => 'MenuController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_delete'], 'uses' => 'MenuController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.menu.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_update'], 'uses' => 'MenuController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.menu.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_list', 'acl:interactivesolutions_honeycomb_menu_routes_menu_create'], 'uses' => 'MenuController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.menu.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_force_delete'], 'uses' => 'MenuController@apiForceDelete']);
        });
    });
});


//src/app/routes//admin/03_routes.groups.php


Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('groups', ['as' => 'admin.routes.menu.groups.index', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@adminIndex']);

    Route::group(['prefix' => 'api/groups'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.groups', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_create'], 'uses' => 'GroupsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_delete'], 'uses' => 'GroupsController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.groups.list', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.groups.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_update'], 'uses' => 'GroupsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.groups.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_create', 'acl:interactivesolutions_honeycomb_menu_routes_groups_delete'], 'uses' => 'GroupsController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.groups.force', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_force_delete'], 'uses' => 'GroupsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.groups.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_update'], 'uses' => 'GroupsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_delete'], 'uses' => 'GroupsController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.groups.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_update'], 'uses' => 'GroupsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.groups.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_list', 'acl:interactivesolutions_honeycomb_menu_routes_groups_create'], 'uses' => 'GroupsController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.groups.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_force_delete'], 'uses' => 'GroupsController@apiForceDelete']);
        });
    });
});


//src/app/routes//admin/04_routes.menu.groups.php


Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('menu/groups', ['as' => 'admin.routes.menu.groups.index', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_list'], 'uses' => 'menu\\GroupsController@adminIndex']);

    Route::group(['prefix' => 'api/menu/groups'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.menu.groups', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_list'], 'uses' => 'menu\\GroupsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_create'], 'uses' => 'menu\\GroupsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_delete'], 'uses' => 'menu\\GroupsController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.menu.groups.list', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_list'], 'uses' => 'menu\\GroupsController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.menu.groups.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_update'], 'uses' => 'menu\\GroupsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.menu.groups.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_create', 'acl:interactivesolutions_honeycomb_menu_routes_menu_groups_delete'], 'uses' => 'menu\\GroupsController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.menu.groups.force', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_force_delete'], 'uses' => 'menu\\GroupsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.menu.groups.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_list'], 'uses' => 'menu\\GroupsController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_update'], 'uses' => 'menu\\GroupsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_delete'], 'uses' => 'menu\\GroupsController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.menu.groups.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_update'], 'uses' => 'menu\\GroupsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.menu.groups.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_list', 'acl:interactivesolutions_honeycomb_menu_routes_menu_groups_create'], 'uses' => 'menu\\GroupsController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.menu.groups.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_groups_force_delete'], 'uses' => 'menu\\GroupsController@apiForceDelete']);
        });
    });
});


//src/app/routes//api/01_routes.menu.types.php


Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/menu-types'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.menu.types', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'MenuTypesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_create'], 'uses' => 'MenuTypesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'MenuTypesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.menu.types.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'MenuTypesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.menu.types.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'MenuTypesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.menu.types.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'MenuTypesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.menu.types.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_create', 'acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'MenuTypesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.menu.types.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_force_delete'], 'uses' => 'MenuTypesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.menu.types.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'MenuTypesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'MenuTypesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'MenuTypesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.menu.types.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'MenuTypesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.menu.types.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_list', 'acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_create'], 'uses' => 'MenuTypesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.menu.types.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_types_force_delete'], 'uses' => 'MenuTypesController@apiForceDelete']);
        });
    });
});

//src/app/routes//api/02_routes.menu.php


Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/menu'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.menu', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_create'], 'uses' => 'MenuController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_delete'], 'uses' => 'MenuController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.menu.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.menu.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.menu.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_update'], 'uses' => 'MenuController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.menu.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_create', 'acl-apps:interactivesolutions_honeycomb_menu_routes_menu_delete'], 'uses' => 'MenuController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.menu.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_force_delete'], 'uses' => 'MenuController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.menu.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_update'], 'uses' => 'MenuController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_delete'], 'uses' => 'MenuController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.menu.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_update'], 'uses' => 'MenuController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.menu.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_list', 'acl-apps:interactivesolutions_honeycomb_menu_routes_menu_create'], 'uses' => 'MenuController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.menu.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_force_delete'], 'uses' => 'MenuController@apiForceDelete']);
        });
    });
});

//src/app/routes//api/03_routes.groups.php


Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/groups'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.groups', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_create'], 'uses' => 'GroupsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_delete'], 'uses' => 'GroupsController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.groups.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.groups.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.groups.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_update'], 'uses' => 'GroupsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.groups.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_create', 'acl-apps:interactivesolutions_honeycomb_menu_routes_groups_delete'], 'uses' => 'GroupsController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.groups.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_force_delete'], 'uses' => 'GroupsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.groups.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_update'], 'uses' => 'GroupsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_delete'], 'uses' => 'GroupsController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.groups.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_update'], 'uses' => 'GroupsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.groups.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_list', 'acl-apps:interactivesolutions_honeycomb_menu_routes_groups_create'], 'uses' => 'GroupsController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.groups.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_groups_force_delete'], 'uses' => 'GroupsController@apiForceDelete']);
        });
    });
});

//src/app/routes//api/04_routes.menu.groups.php


Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/menu/groups'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.menu.groups', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_list'], 'uses' => 'menu\\GroupsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_create'], 'uses' => 'menu\\GroupsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_delete'], 'uses' => 'menu\\GroupsController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.menu.groups.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_menu_routes_menu_groups_list'], 'uses' => 'menu\\GroupsController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.menu.groups.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_list'], 'uses' => 'menu\\GroupsController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.menu.groups.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_update'], 'uses' => 'menu\\GroupsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.menu.groups.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_create', 'acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_delete'], 'uses' => 'menu\\GroupsController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.menu.groups.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_force_delete'], 'uses' => 'menu\\GroupsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.menu.groups.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_list'], 'uses' => 'menu\\GroupsController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_update'], 'uses' => 'menu\\GroupsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_delete'], 'uses' => 'menu\\GroupsController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.menu.groups.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_update'], 'uses' => 'menu\\GroupsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.menu.groups.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_list', 'acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_create'], 'uses' => 'menu\\GroupsController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.menu.groups.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_menu_routes_menu_groups_force_delete'], 'uses' => 'menu\\GroupsController@apiForceDelete']);
        });
    });
});
