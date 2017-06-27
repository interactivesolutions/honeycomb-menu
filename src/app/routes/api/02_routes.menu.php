<?php

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