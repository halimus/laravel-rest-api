<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use App\Models\Languages;
use App\Transformer\LanguagesTransformer;

class LanguagesController extends Controller {

    use Helpers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$languages = Languages::all();
        $languages = Languages::paginate(10);

        if ($languages->count()) {
            //return response()->json(['data' => $languages]); // Use this by default
            //return $this->response->array($languages->toArray()); // Use this if you using Dingo Api Routing Helpers
            //return $this->response->collection($languages, new LanguagesTransformer()); // Use this if you using Fractal <=> Create a resource collection transformer
            return $this->response->paginator($languages, new LanguagesTransformer); // Use this if you using Fractal Responding With Paginated Items 
        } 
        else {
            //return response()->json(['message' => 'Could not find the languages', 'status_code'=> '404'], 404); // Use this by default
            //return $this->response->errorNotFound();
            return $this->response->errorNotFound('Could not find the languages'); // Use this if you you using Dingo Api Routing Helpers
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
            //return $this->response->error('Could not create new language.', 400);   // You can use this
            //return $this->response->errorBadRequest('Could not create new language.'); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not create new language.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        if(Languages::create($input)){
            return $this->response->created();
            //return response()->setStatusCode(201, 'The resource is created successfully!');
            //response()->json(['status' => 'The resource is created successfully'], 200);
            //response('The resource is created successfully, 200);
        }
        else{
            //return $this->response->error('could_not_create_language', 500); // you can use this
            return $this->response->errorInternal('could_not_create_language'); // or this
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $language = Languages::find($id);
        if (!$language) {
            //return $this->response->error('Could not find the language', 404);  // Use this by default
            return $this->response->errorNotFound('Could not find the language'); // Use this if you you using Dingo Api Routing Helpers
        }
        //return response()->json(['data' => $language]);  // Use this by default
        //return $this->response->array($language->toArray()); // Use this if you using Dingo Api Routing Helpers
        return $this->response->item($language, new LanguagesTransformer()); // Use this if you using Fractal 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $language = Languages::find($id);
        if (!$language) {
            //return $this->response->error('Could not find the language', 404);
            return $this->response->errorNotFound('Could not find the language');
        }
        
        $input = $request->all();
        $validator = $this->validator_update($input, $id);
        if ($validator->fails()) {
            //return $this->response->error('Could not update a language.', 400);   // You can use this
            //return $this->response->errorBadRequest('Could not update a language.'); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not update a language.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        $language->fill($input);
        if($language->save()){
            return $this->response->noContent(); // noContent -> HTTP Code 304
        }
        else{
            //return $this->response->error('could_not_update_language', 500); // you can use this
            return $this->response->errorInternal('could_not_update_language'); // or this
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $language = Languages::find($id);
        if (!$language) {
            //return $this->response->error('Could not find the language', 404);
            return $this->response->errorNotFound('Could not find the language');
        }
        
        if($language->delete()){ // physical delete
            return $this->response->noContent();
        }
        else{
           //return $this->response->error('could_not_delete_language', 500); 
           return $this->response->errorInternal('could_not_delete_language');
        }
    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator_create($data){
        return Validator::make($data, [
            'language_name' => 'required|max:45',
            'language_code' => 'required|max:2|unique:languages',
        ]);
    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator_update($data, $language_id){
        $rules = array();
        if (array_key_exists('language_name', $data)){
            $rules['language_name'] = 'required|max:45';
        }
        if (array_key_exists('language_code', $data)){
            $rules['language_code'] = 'required|max:2|unique:languages,language_code, ' . $language_id . ',language_id';
        }
        return Validator::make($data,
            $rules
        );    
    }

}
