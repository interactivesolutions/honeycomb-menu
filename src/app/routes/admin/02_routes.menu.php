<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('menu', ['as' => 'admin.routes.menu.index', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@adminIndex']);

    Route::group(['prefix' => 'api/menu'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.menu', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_list'], 'uses' => 'MenuController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_create'], 'uses' => 'MenuController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_menu_delete'], 'uses' => 'MenuController@apiDestroy']);

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
