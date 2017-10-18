<?php

namespace interactivesolutions\honeycombmenu\app\models\menu;

use InteractiveSolutions\HoneycombCore\Models\HCUuidModel;
use interactivesolutions\honeycomblanguages\app\models\HCLanguages;
use interactivesolutions\honeycombmenu\app\models\HCMenu;

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
    protected $fillable = ['id', 'name', 'language_code', 'sequence'];

    /**
     * Menu items
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menu()
    {
        return $this->belongsToMany(HCMenu::class, 'hc_menu_groups_menu_connection', 'menu_group_id', 'menu_id')
            ->withPivot('sequence')
            ->withTimestamps();
    }

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(HCLanguages::class, 'language_code', 'iso_639_1');
    }
}