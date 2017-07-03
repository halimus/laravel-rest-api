<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'language_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_name', 'language_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    /**
     * Get the books for the language.
     */
    public function books(){
        return $this->hasMany('App\Models\Book', 'language_id');
    }
    
}
