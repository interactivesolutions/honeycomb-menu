<?php

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