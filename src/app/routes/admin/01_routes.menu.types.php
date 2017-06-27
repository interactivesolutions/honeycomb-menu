<?php

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