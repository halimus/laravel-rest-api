<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

use App\Models\Author;


class AuthorBookController extends Controller {

    use Helpers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {  
        $author = Author::find($id);
        if (!$author) {
            //return $this->response->error('Could not find the author', 404);  // Use this by default
            return $this->response->errorNotFound('Could not find the author'); // Use this if you you using Dingo Api Routing Helpers
        }
        
        $books = $author->books()->paginate(10);
        //$books = $author->PaginateBooks();
        return $this->response->paginator($books, new \App\Transformer\BookTransformer()); 
    }

}
