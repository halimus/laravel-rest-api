<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use App\Models\Author;
use App\Transformer\AuthorTransformer;

class AuthorController extends Controller {

    use Helpers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$author = Author::all();
        $author = Author::paginate(10);
        
        if ($author->count()) {
            //return response()->json(['data' => $author]); // Use this by default
            //return $this->response->array($author->toArray()); // Use this if you using Dingo Api Routing Helpers
            //return $this->response->collection($languages, new LanguagesTransformer()); // Use this if you using Fractal <=> Create a resource collection transformer
            return $this->response->paginator($author, new AuthorTransformer); // Use this if you using Fractal Responding With Paginated Items 
        } 
        else {
            //return response()->json(['message' => 'Could not find the author', 'status_code'=> '404'], 404); // Use this by default
            //return $this->response->errorNotFound();
            return $this->response->errorNotFound('Could not find the author'); // Use this if you you using Dingo Api Routing Helpers
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
            //return $this->response->error('Could not create new author.', 400);   // You can use this
            //return $this->response->errorBadRequest('Could not create new author.'); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not create new author.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        if(Author::create($input)){
            return $this->response->created();
            //return response()->setStatusCode(201, 'The resource is created successfully!');
            //response()->json(['status' => 'The resource is created successfully'], 200);
            //response('The resource is created successfully, 200);
        }
        else{
            //return $this->response->error('could_not_create_author', 500); // you can use this
            return $this->response->errorInternal('could_not_create_author'); // or this
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $author = Author::find($id);
        if (!$author) {
            //return $this->response->error('Could not find the author', 404);  // Use this by default
            return $this->response->errorNotFound('Could not find the author'); // Use this if you you using Dingo Api Routing Helpers
        }
        //return response()->json(['data' => $author]);  // Use this by default
        //return $this->response->array($author->toArray()); // Use this if you using Dingo Api Routing Helpers
        return $this->response->item($author, new AuthorTransformer()); // Use this if you using Fractal 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $author = Author::find($id);
        if (!$author) {
            //return $this->response->error('Could not find the author', 404);
            return $this->response->errorNotFound('Could not find the author');
        }
        
        $input = $request->all();
        $validator = $this->validator_update($input, $id);
        if ($validator->fails()) {
            //return $this->response->error('Could not update a author.', 400);   // You can use this
            //return $this->response->errorBadRequest('Could not update a author.'); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not update a author.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        $author->fill($input);
        if($author->save()){
            return $this->response->noContent(); // noContent -> HTTP Code 304
        }
        else{
            //return $this->response->error('could_not_update_author', 500); // you can use this
            return $this->response->errorInternal('could_not_update_author'); // or this
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $author = Author::find($id);
        if (!$author) {
            //return $this->response->error('Could not find the author', 404);
            return $this->response->errorNotFound('Could not find the author');
        }
        
        if($author->delete()){ // physical delete
            return $this->response->noContent();
        }
        else{
           //return $this->response->error('could_not_delete_author', 500); 
           return $this->response->errorInternal('could_not_delete_author');
        }
    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator_create($data){
        return Validator::make($data, [
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:25',
        ]);
    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator_update($data, $language_id){
        $rules = array();
        if (array_key_exists('first_name', $data)){
            $rules['language_name'] = 'required|max:25';
        }
        if (array_key_exists('last_name', $data)){
            $rules['last_name'] = 'required|max:25';
        }
        return Validator::make($data,
            $rules
        );    
    }

}
