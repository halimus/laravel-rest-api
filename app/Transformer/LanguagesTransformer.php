<?php

namespace App\Transformer;

use App\Models\Languages;
use League\Fractal;

class LanguagesTransformer extends Fractal\TransformerAbstract {

    /**
     * 
     * @param Languages $language
     * @return type
     */
    public function transform(Languages $language) {
        return [
            'id'    => (int) $language->language_id,
            'language_name' => $language->language_name,
            'language_code' => $language->language_code,
            'link' => [
                [
                    'uri' => url('api/language/'.$language->language_id),
                    'book' => url('api/language/'.$language->language_id.'/book')
                ]
            ],
        ]; 
    }
    

}
