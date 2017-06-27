<?php

namespace interactivesolutions\honeycombmenu\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCMenuGroups extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_menu_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'sequence'];
}