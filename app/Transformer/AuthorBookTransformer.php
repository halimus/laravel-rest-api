<?php

namespace App\Transformer;

use App\Models\Author;
use App\Models\Book;
use League\Fractal;

class AuthorBookTransformer extends Fractal\TransformerAbstract {

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
                    'uri' => url('api/author/'.$author->author_id)
                ]
            ],
        ]; 
    }
    
}
