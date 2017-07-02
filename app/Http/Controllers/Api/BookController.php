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
        $input = $request->all();
        $validator = $this->validator_create($input);
        if ($validator->fails()) {
            //return $this->response->error('Could not create new book.', 400);   // You can use this
            //return $this->response->errorBadRequest('Could not create new book.'); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not create new book.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        //$input['created_at'] = date('Y-m-d H:i:s');
        //$input['created_at'] = \Carbon\Carbon::now();
        $input['created_at'] =  \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        //$slug = str_slug($input['title'], '-');
        //$input['slug'] = $slug;
        
        if(Book::create($input)){
            return $this->response->created();
            //return response()->setStatusCode(201, 'The resource is created successfully!');
            //response()->json(['status' => 'The resource is created successfully'], 200);
            //response('The resource is created successfully, 200);
        }
        else{
            //return $this->response->error('could_not_create_book', 500); // you can use this
            return $this->response->errorInternal('could_not_create_book'); // or this
        } 
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
        return $this->response->item($book, new BookTransformer()); // Use this if you using Fractal 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $book = Book::find($id);
        if (!$book) {
            //return $this->response->error('Could not find the book', 404);
            return $this->response->errorNotFound('Could not find the book');
        }
        
        $input = $request->all();
        $validator = $this->validator_update($input);
        if ($validator->fails()) {
            //return $this->response->error('Could not update a book.', 400);   // You can use this
            //return $this->response->errorBadRequest('Could not update a book.'); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not update a book.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        $input['updated_at'] =  \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        $book->fill($input);
        if($book->save()){
            return $this->response->noContent(); // noContent -> HTTP Code 304
        }
        else{
            //return $this->response->error('could_not_update_book', 500); // you can use this
            return $this->response->errorInternal('could_not_update_book'); // or this
        }
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
    
    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator_create($data){
        return Validator::make($data, [
            'title' => 'required|min:2',
            'pages' => 'required|numeric|min:10|max:999',
            'published_at' => 'date|date_format:Y-m-d|before:tomorrow', // Accept today date
            'language_id' => 'required|exists:languages,language_id',
            'author_id' => 'required|exists:author,author_id'
        ]);
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator_update($data){
        $rules = array();
        if (array_key_exists('title', $data)){
            $rules['title'] = 'required|min:2';
        }
        if (array_key_exists('pages', $data)){
            $rules['pages'] = 'required|numeric|min:10|max:999';
        }
        if (array_key_exists('published_at', $data)){
            $rules['published_at'] = 'date|date_format:Y-m-d|before:tomorrow';
        }
        if (array_key_exists('language_id', $data)){
            $rules['language_id'] = 'required|exists:languages,language_id';
        }
        if (array_key_exists('author_id', $data)){
            $rules['author_id'] = 'required|exists:author,author_id';
        }
        
        return Validator::make($data,
            $rules
        );    
    }
    
    
}
