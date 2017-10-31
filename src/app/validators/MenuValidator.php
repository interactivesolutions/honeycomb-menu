<?php namespace interactivesolutions\honeycombmenu\app\validators;


use InteractiveSolutions\HoneycombCore\Http\Controllers\HCCoreFormValidator;

class MenuValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'language' => 'required|exists:hc_languages,iso_639_1',
            'parent' => 'nullable|exists:hc_menu,id',
            'menu_type' => 'required|exists:hc_menu_types,id',
            'type' => 'required',
//            'dropdown'  => 'required',
//            'icon'      => 'required',
//            'url'       => 'required_if:type,link|active_url',
            'link_text' => 'required_if:type,link',
//            'page'      => 'required_if:type,page|exists:hc_pages,id,type,PAGE',
//            'sequence'  => 'required',
        ];
    }
}