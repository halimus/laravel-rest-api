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
            'title' => $book->title,
            'slug' => $book->slug,
            'description' => $book->description,
            'ISBN' => $book->ISBN,
            'pages' => $book->pages,
            'published_at' => $book->published_at,
            'language_id' => $book->language_id,
            'author_id' => $book->author_id,
//            'created_at' => $book->created_at,
//            'updated_at' => $book->updated_at,
            'link' => [
                [
                    'uri' => url('api/book/'.$book->book_id),
                    'language' => url('api/language/'.$book->language_id),
                    'author' => url('api/author/'.$book->author_id)
                ]
            ],
        ]; 
    }
    
}
