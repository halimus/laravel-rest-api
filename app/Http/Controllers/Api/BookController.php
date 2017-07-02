<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Transformer\BookTransformer;

class BookController extends Controller {

    use Helpers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$book = Book::all();
        $book = Book::paginate(10);
        if ($book->count()) {
            //return response()->json(['data' => $book]); // Use this by default
            //return $this->response->array($book->toArray()); // Use this if you using Dingo Api Routing Helpers
            //return $this->response->collection($book, new BookTransformer()); // Use this if you using Fractal <=> Create a resource collection transformer
            return $this->response->paginator($book, new BookTransformer()); // Use this if you using Fractal Responding With Paginated Items 
        } 
        else {
            //return response()->json(['message' => 'Could not find the book', 'status_code'=> '404'], 404); // Use this by default
            //return $this->response->errorNotFound();
            return $this->response->errorNotFound('Could not find the book'); // Use this if you you using Dingo Api Routing Helpers
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $book = Book::find($id);
        if (!$book) {
            //return $this->response->error('Could not find the book', 404);  // Use this by default
            return $this->response->errorNotFound('Could not find the book'); // Use this if you you using Dingo Api Routing Helpers
        }
        //return response()->json(['data' => $book]);  // Use this by default
        //return $this->response->array($book->toArray()); // Use this if you using Dingo Api Routing Helpers
        return $this->response->item($author, new BookTransformer()); // Use this if you using Fractal 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $book = Book::find($id);
        if (!$book) {
            //return $this->response->error('Could not find the book', 404);
            return $this->response->errorNotFound('Could not find the book');
        }
        
        if($book->delete()){ // physical delete
            return $this->response->noContent();
        }
        else{
           //return $this->response->error('could_not_delete_book', 500); 
           return $this->response->errorInternal('could_not_delete_book');
        } 
    }

}
