<?php namespace interactivesolutions\honeycombmenu\app\validators;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class GroupsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name'     => 'required',
            'language' => 'required|exists:hc_languages,iso_639_1',
        ];
    }
}