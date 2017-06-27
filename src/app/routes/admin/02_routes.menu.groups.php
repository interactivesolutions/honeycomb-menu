<?php

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
