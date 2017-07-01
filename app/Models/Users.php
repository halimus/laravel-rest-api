<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model {
    
    
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    //public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password', 'role', 'status', 'ip_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ip_address',
    ];
    

}
