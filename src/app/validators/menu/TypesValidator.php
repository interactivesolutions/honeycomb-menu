<?php namespace interactivesolutions\honeycombmenu\app\validators\menu;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class TypesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'id' => 'required',
        ];
    }
}