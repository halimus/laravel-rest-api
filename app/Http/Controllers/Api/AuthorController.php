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

}
