<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';
    protected $primaryKey = 'author_id';
    //public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    
    /**
     * Get the books for the author.
     */
    public function books(){
        //return $this->hasMany('App\Models\Book', 'foreign_key');
        return $this->hasMany('App\Models\Book', 'author_id', 'author_id');
    }
    
    /**
     * 
     * @return type
     */
    public function PaginateBooks(){
        return $this->books()->paginate(10);
    }
    
}
