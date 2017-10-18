<?php

namespace interactivesolutions\honeycombmenu\app\models\menu;


use InteractiveSolutions\HoneycombCore\Models\HCUuidModel;
use InteractiveSolutions\HoneycombCore\Models\Traits\CustomAppends;

class HCMenuTypes extends HCUuidModel
{
    use CustomAppends;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_menu_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id'];

    /**
     * Get label attribute
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getLabelAttribute()
    {
        return $this->id;
    }
}