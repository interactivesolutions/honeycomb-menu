<?php

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