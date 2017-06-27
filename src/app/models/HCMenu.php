<?php

namespace interactivesolutions\honeycombmenu\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombcore\models\traits\CustomAppends;
use interactivesolutions\honeycomblanguages\app\models\HCLanguages;
use interactivesolutions\honeycombmenu\app\helpers\MenuHelper;
use interactivesolutions\honeycombmenu\app\models\menu\HCMenuGroups;
use interactivesolutions\honeycombmenu\app\models\menu\HCMenuTypes;
use interactivesolutions\honeycombpages\app\models\HCPages;

class HCMenu extends HCUuidModel
{
    use CustomAppends;

    /**
     * Menu id
     *
     * @var
     */
    public static $menuTypeId;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'menu_type_id', 'type', 'dropdown', 'icon', 'url', 'link_text', 'page_id', 'sequence', 'language_code'];

    /**
     * Get label attribute
     *
     * @return mixed|string
     */
    public function getItemLabelAttribute()
    {
        if( $this->type == 'link' ) {
            return $this->link_text;
        }

        if( $this->type == 'page' && ! is_null($this->page) )
            return get_translation_name('title', $this->language_code, $this->page->translations->toArray());

        return '';
    }

    /**
     * Get label attribute
     *
     * @return mixed|string
     */
    public function getItemUrlAttribute()
    {
        if( $this->type == 'link' ) {
            return $this->url;
        }

        if( $this->type == 'page' && ! is_null($this->page) )
            return $this->page->page_url;

        return '';
    }

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu_type()
    {
        return $this->belongsTo(HCMenuTypes::class, 'menu_type_id', 'id');
    }

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(HCPages::class, 'page_id', 'id');
    }

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(get_class($this), 'parent_id', 'id');
    }

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_item()
    {
        return $this->belongsTo(get_class($this), 'parent_id', 'id');
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

    /**
     * Sub children
     *
     * @return mixed
     */
    public function subChildren()
    {
        return $this->hasMany(get_class($this), 'parent_id', 'id')
            ->where('menu_type_id', self::$menuTypeId);
    }

    /**
     * Children
     *
     * @return mixed
     */
    public function children()
    {
        return $this->subChildren()
            ->with(['children' => function ($query) {
                $query->select(HCMenu::getFillableFields());
            }])
            ->select(HCMenu::getFillableFields());
    }

    /**
     * Menu groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menu_groups()
    {
        return $this->belongsToMany(HCMenuGroups::class, 'hc_menu_groups_menu_connection', 'menu_id', 'menu_group_id')
            ->withPivot('sequence')
            ->withTimestamps();
    }

    /**
     * Clear menu cache
     */
    public function forgetMenuCache()
    {
        MenuHelper::clearCache($this->menu_type_id, $this->language_code);
    }
}