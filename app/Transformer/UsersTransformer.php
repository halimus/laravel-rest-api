<?php

namespace App\Transformer;

use App\Models\Users;
use League\Fractal;

class UsersTransformer extends Fractal\TransformerAbstract {

    /**
     * 
     * @param Users $user
     * @return type
     */
    public function transform(Users $user) {
        return [
            'id'    => (int) $user->user_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'role' => $user->role,
            'status' => $user->status,
            //'created_at' => $user->created_at,
            //'updated_at' => $user->updated_at,
            'link' => [
                [
                    'uri' => url('api/users/'.$user->user_id)
                ]
            ],
        ]; 
    }
    
    /**
     * 
     * @param \App\Transformer\Users $user
     * @return type
     */
    public function includePhone(Users $user){
        $phone = $user->phone;
        return $this->item($phone, new UsersTransformer);
    }

}
