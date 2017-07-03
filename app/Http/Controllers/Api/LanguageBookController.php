<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

use App\Models\Languages;

class LanguageBookController extends Controller {

    use Helpers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {
        $language = Languages::find($id);
        if (!$language) {
            //return $this->response->error('Could not find the language', 404);  // Use this by default
            return $this->response->errorNotFound('Could not find the language'); // Use this if you you using Dingo Api Routing Helpers
        }
        
        $books = $language->books()->paginate(10);
        //$books = $language->PaginateBooks();
        return $this->response->paginator($books, new \App\Transformer\BookTransformer()); 
    }

}
