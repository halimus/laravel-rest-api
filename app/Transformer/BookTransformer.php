<?php

namespace App\Transformer;

use App\Models\Book;
use League\Fractal;

class BookTransformer extends Fractal\TransformerAbstract {

    /**
     * 
     * @param Book $book
     * @return type
     */
    public function transform(Book $book) {
        return [
            'id'    => (int) $book->book_id,
            'title' => $author->title,
            'description' => $author->description,
            'ISBN' => $author->ISBN,
            'pages' => $author->pages,
            'published_at' => $author->published_at,
            'language_id' => $author->language_id,
            'author_id' => $author->author_id,
//            'created_at' => $author->created_at,
//            'updated_at' => $author->updated_at,
            'link' => [
                [
                    'uri' => url('api/book/'.$book->book_id)
                ]
            ],
        ]; 
    }
    
}
