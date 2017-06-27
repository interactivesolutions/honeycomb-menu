<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('menu/types', ['as' => 'admin.routes.menu.types.index', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'menu\\TypesController@adminIndex']);

    Route::group(['prefix' => 'api/menu/types'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.menu.types', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'menu\\TypesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_create'], 'uses' => 'menu\\TypesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'menu\\TypesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.menu.types.list', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'menu\\TypesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.menu.types.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'menu\\TypesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.menu.types.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_create', 'acl:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'menu\\TypesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.menu.types.force', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_force_delete'], 'uses' => 'menu\\TypesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.menu.types.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list'], 'uses' => 'menu\\TypesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'menu\\TypesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_delete'], 'uses' => 'menu\\TypesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.menu.types.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_update'], 'uses' => 'menu\\TypesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.menu.types.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_list', 'acl:interactivesolutions_honeycomb_menu_routes_menu_types_create'], 'uses' => 'menu\\TypesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.menu.types.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_types_force_delete'], 'uses' => 'menu\\TypesController@apiForceDelete']);
        });
    });
});
