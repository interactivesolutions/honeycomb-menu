<?php

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