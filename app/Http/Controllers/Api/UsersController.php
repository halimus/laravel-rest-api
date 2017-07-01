<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Dingo\Api\Routing\Helpers;
use App\Transformer\UsersTransformer;
USE Illuminate\Support\Facades\DB;
use App\Models\Users;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Response;


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
            //return response()->json(['results' => $users]); // Use this by default
            //return $this->response->array($users->toArray()); // Use this if you using Dingo Api Routing Helpers
            //return $this->response->collection($users, new UsersTransformer()); // Use this if you using Fractal 
           return $this->response->paginator($users, new UsersTransformer); // Use this if you using Fractal Responding With Paginated Items 
        }
        else{
            //return response()->json(['message' => 'Could not find the users', 'status_code'=> '404'], 404); // Use this by default
            //return $this->response->errorNotFound();
            return $this->response->errorNotFound('Could not find the users'); // Use this if you you using Dingo Api Routing Helpers
        }
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    private function validator($data){
        return Validator::make($data, [
            'first_name' => 'required|max:10',
            'last_name' => 'required|max:10',
            'email' => 'required|unique:users',
            'password' => 'required|min:4',
            'role' => 'required|in:administrator,colaborator',
            'status' => 'required|in:active,inactive'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = $this->validator($input);
        if ($validator->fails()) {
            //return $this->response->error('Could not create new user.', 400);   // You can use this
            //return $this->response->errorBadRequest(''Could not create new user.''); // or this
            return Response::json(array(   // Better if use this with errors validation
                'message'   =>  'Could not create new user.',
                'errors'   =>  $validator->errors(),
                'status_code'      =>  400
            ), 400);
        }
        
        $input['password'] = bcrypt($request['password']);
        $input['ip_address'] = $request->ip();
        //die($input['ip_address']);
        //$input['created_at'] = date('Y-m-d H:i:s');
        //$input['created_at'] = \Carbon\Carbon::now();
        $input['created_at'] =  \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        if(Users::create($input)){
            return $this->response->created();
        }
        else{
            return $this->response->error('could_not_create_user', 500);
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
        //return response()->json(['result' => $user]);  // Use this by default
        //return $this->response->array($user->toArray()); // Use this if you using Dingo Api Routing Helpers
        return $this->response->item($user, new UsersTransformer()); // Use this if you using Fractal 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
