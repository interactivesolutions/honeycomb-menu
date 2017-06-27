<?php

namespace interactivesolutions\honeycombmenu\app\forms;

use interactivesolutions\honeycombmenu\app\models\HCMenu;
use interactivesolutions\honeycombmenu\app\models\HCMenuTypes;

class MenuForm
{
    // name of the form
    protected $formID = 'menu';

    // is form multi language
    protected $multiLanguage = 0;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.routes.menu'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    'type'            => 'dropDownList',
                    'fieldID'         => 'language',
                    'label'           => trans('HCTranslations::core.language'),
                    'editType'        => 0,
                    'required'        => 1,
                    'requiredVisible' => 1,
                    'options'         => getHCLanguagesOptions('front_end', ['language']),
                    "search"          => [
                        "minimumInputLength"     => 0,
                        "maximumSelectionLength" => 1,
                    ],
                    "value"           => session('back-end', app()->getLocale()),
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "icon",
                    "label"           => trans("HCMenu::menu.icon"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    'type'            => 'dropDownList',
                    'fieldID'         => 'menu_type',
                    'label'           => trans('HCMenu::menu.menu_type_id'),
                    'editType'        => 0,
                    'required'        => 1,
                    'requiredVisible' => 1,
                    "options"         => $this->getMenuList(),
                    "search"          => [
                        "minimumInputLength"     => 0,
                        "maximumSelectionLength" => 1,
                    ],
                ],
                [
                    'type'            => 'dropDownList',
                    'fieldID'         => 'menu_groups',
                    'label'           => trans('HCMenu::menu.menu_groups'),
                    'editType'        => 0,
                    'required'        => 0,
                    'requiredVisible' => 0,
                    "search"          => [
                        "url"                    => route('admin.api.routes.menu.groups.search'),
                        "minimumInputLength"     => 0,
                        "maximumSelectionLength" => 10,
                        "showNodes"              => [
                            'name',
                        ],
                    ],
                    "dependencies"    => [
                        [
                            "field_id" => "language",
                        ],
                    ],
                ],
                [
                    'type'            => 'dropDownList',
                    'fieldID'         => 'parent',
                    'label'           => trans('HCMenu::menu.parent_id'),
                    'editType'        => 0,
                    'required'        => 0,
                    'requiredVisible' => 0,
                    "search"          => [
                        "url"                    => route('admin.api.routes.menu.search'),
                        "minimumInputLength"     => 1,
                        "maximumSelectionLength" => 1,
                        "showNodes"              => [
                            "item_label",
                        ],
                    ],
                    "dependencies"    => [
                        [
                            "field_id" => "language",
                        ],
                        [
                            "field_id" => "menu_type",
                        ],
                    ],
                ],
                [
                    'type'            => 'radioList',
                    'fieldID'         => 'type',
                    'label'           => trans('HCMenu::menu.type'),
                    'editType'        => 0,
                    'required'        => 1,
                    'requiredVisible' => 1,
                    'options'         => HCMenu::getTableEnumList('type', 'label', 'HCMenu::menu.types.'),
                    'dependencies'    => [
                        [
                            'field_id' => 'language',
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "link_text",
                    "label"           => trans("HCMenu::menu.link_text"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "dependencies"    => [
                        [
                            'field_id' => "type",
                            'value_id' => 'link',
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "url",
                    "label"           => trans("HCMenu::menu.url"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "dependencies"    => [
                        [
                            'field_id' => "type",
                            'value_id' => 'link',
                        ],
                    ],
                ],
                [
                    'type'            => 'dropDownList',
                    'fieldID'         => 'page',
                    'label'           => trans('HCMenu::menu.page_id'),
                    'editType'        => 0,
                    'required'        => 0,
                    'requiredVisible' => 0,
                    "search"          => [
                        "minimumInputLength"     => 1,
                        "maximumSelectionLength" => 1,
//                        "url"                    => route('admin.api.pages.search'),
                        "showNodes"              => [
                            "title",
                        ],
                    ],
                    "dependencies"    => [
                        [
                            "field_id" => "language",
                        ],
                        [
                            'field_id' => "type",
                            'value_id' => 'page',
                        ],
                    ],
                ],
            ],
        ];

        if( $this->multiLanguage )
            $form['availableLanguages'] = getHCContentLanguages();

        if( ! $edit )
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }

    /**
     * Get menu list
     *
     * @return mixed
     */
    public function getMenuList()
    {
        HCMenuTypes::$customAppends = ['label'];

        return HCMenuTypes::select('id')->get()->sortBy('label')->values();
    }
}