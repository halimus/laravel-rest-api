<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Transformer\UsersTransformer;


class UsersController extends Controller {

    use Helpers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() { 
        //$users = Users::all();
        //$users = Users::where('status', '<>', 'deleted')->get();
        //$users = Users::paginate(20);
        $users = Users::where('status', '<>', 'deleted')->paginate(10);
        
        if($users->count()){
            //return response()->json(['data' => $users]); // Use this by default
            //return $this->response->array($users->toArray()); // Use this if you using Dingo Api Routing Helpers
            //return $this->response->collection($users, new UsersTransformer()); // Use this if you using Fractal <=> Create a resource collection transformer
           return $this->response->paginator($users, new UsersTransformer); // Use this if you using Fractal Responding With Paginated Items 
        }
        else{
            //return response()->json(['message' => 'Could not find the users', 'status_code'=> '404'], 404); // Use this by default
            //return $this->response->errorNotFound();
            return $this->response->errorNotFound('Could not find the users'); // Use this if you you using Dingo Api Routing Helpers
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
            //return $this->response->error('Could not create new user.', 400);   // You can use this
            //return $this->response->errorBadRequest('Could not create new user.'); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not create new user.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        $input['password'] = bcrypt($request['password']);
        $input['ip_address'] = $request->ip();
        //$input['created_at'] = date('Y-m-d H:i:s');
        //$input['created_at'] = \Carbon\Carbon::now();
        $input['created_at'] =  \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        if(Users::create($input)){
            return $this->response->created();
            //return response()->setStatusCode(201, 'The resource is created successfully!');
            //response()->json(['status' => 'The resource is created successfully'], 200);
            //response('The resource is created successfully, 200);
        }
        else{
            //return $this->response->error('could_not_create_user', 500); // you can use this
            return $this->response->errorInternal('could_not_create_user'); // or this
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //$user = User::find($id);
        $user = Users::where('status', '<>', 'deleted')->find($id);
        
        if (!$user) {
            //return $this->response->error('Could not find the user', 404);  // Use this by default
            return $this->response->errorNotFound('Could not find the user'); // Use this if you you using Dingo Api Routing Helpers
        }
        //return response()->json(['data' => $user]);  // Use this by default
        //return $this->response->array($user->toArray()); // Use this if you using Dingo Api Routing Helpers
        return $this->response->item($user, new UsersTransformer()); // Use this if you using Fractal 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id) {
        //$user = Users::find($id);
        $user = Users::where('status', '<>', 'deleted')->find($id);
        if (!$user) {
            //return $this->response->error('Could not find the user', 404);
            return $this->response->errorNotFound('Could not find the user');
        }
        
        $input = $request->all();
        $validator = $this->validator_update($input, $id);
        if ($validator->fails()) {
            //return $this->response->error('Could not update a user.', 400);   // You can use this
            //return $this->response->errorBadRequest('Could not update a user.'); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not update a user.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        if(isset($request['password'])){
            $input['password'] = bcrypt($request['password']);
        }
        $input['updated_at'] =  \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        
        $user->fill($input);
        if($user->save()){
            return $this->response->noContent(); // noContent -> HTTP Code 304
        }
        else{
            //return $this->response->error('could_not_update_user', 500); // you can use this
            return $this->response->errorInternal('could_not_update_user'); // or this
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //$user = Users::find($id);
        $user = Users::where('status', '<>', 'deleted')->find($id);
        if (!$user) {
            //return $this->response->error('Could not find the user', 404);
            return $this->response->errorNotFound('Could not find the user');
        }
        
        $user->fill(['status' => 'deleted']);
        if($user->save()){ // logical delete
            return $this->response->noContent(); // noContent -> HTTP Code 304
        }
//        if($user->delete()){ // physical delete
//            return $this->response->noContent();
//        }
        else{
           //return $this->response->error('could_not_delete_user', 500); 
           return $this->response->errorInternal('could_not_delete_user');
        }
    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator_create($data){
        return Validator::make($data, [
            'first_name' => 'required|max:10',
            'last_name' => 'required|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role' => 'required|in:administrator,colaborator',
            'status' => 'required|in:active,inactive'
        ]);
    }
    
    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator_update($data, $user_id){
        $rules = array();
        if (array_key_exists('first_name', $data)){
            $rules['first_name'] = 'required|max:10';
        }
        if (array_key_exists('last_name', $data)){
            $rules['last_name'] = 'required|max:10';
        }
        if (array_key_exists('email', $data)){
            $rules['email'] = 'required|email|max:45|unique:users,email, ' . $user_id . ',user_id';
        }
        if (array_key_exists('password', $data)){
            $rules['password'] = 'required|min:4';
        }
        if (array_key_exists('role', $data)){
            $rules['role'] = 'required|in:administrator,colaborator';
        }
        if (array_key_exists('status', $data)){
            $rules['status'] = 'required|in:active,inactive';
        }
        
        return Validator::make($data,
            $rules
        );    
    }

}
