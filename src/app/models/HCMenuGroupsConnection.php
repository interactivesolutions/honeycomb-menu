<?php

namespace interactivesolutions\honeycombmenu\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCMenuGroupsConnection extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_menu_groups_menu_connection';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['menu_id', 'menu_group_id', 'sequence'];
}