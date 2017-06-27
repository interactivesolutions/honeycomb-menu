<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('groups', ['as' => 'admin.routes.groups.index', 'middleware' => ['acl:interactivesolutions_honeycomb_menu_routes_groups_list'], 'uses' => 'GroupsController@adminIndex']);

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
