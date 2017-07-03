<?php

namespace App\Transformer;

use App\Models\Author;
use League\Fractal;

class AuthorTransformer extends Fractal\TransformerAbstract {

    /**
     * 
     * @param Author $author
     * @return type
     */
    public function transform(Author $author) {
        return [
            'id'    => (int) $author->author_id,
            'first_name' => $author->first_name,
            'last_name' => $author->last_name,
//            'created_at' => $author->created_at,
//            'updated_at' => $author->updated_at,
            'link' => [
                [
                    'uri' => url('api/author/'.$author->author_id),
                    'book' => url('api/author/'.$author->author_id.'/book')
                ]
            ],
        ]; 
    }
    
}
