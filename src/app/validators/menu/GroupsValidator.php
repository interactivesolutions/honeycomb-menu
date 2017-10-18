<?php namespace interactivesolutions\honeycombmenu\app\validators\menu;


use InteractiveSolutions\HoneycombCore\Http\Controllers\HCCoreFormValidator;

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
            'name' => 'required',
            'language' => 'required|exists:hc_languages,iso_639_1',
        ];
    }
}