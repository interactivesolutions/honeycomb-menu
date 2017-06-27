<?php

namespace interactivesolutions\honeycombmenu\app\forms\menu;

class GroupsForm
{
    // name of the form
    protected $formID = 'menu-groups';

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
            'storageURL' => route('admin.api.routes.menu.groups'),
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
                    "fieldID"         => "name",
                    "label"           => trans("HCMenu::menu_groups.name"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "sequence",
                    "label"           => trans("HCMenu::menu_groups.sequence"),
                    "required"        => 0,
                    "requiredVisible" => 0,
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
}