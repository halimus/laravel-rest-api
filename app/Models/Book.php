<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Book extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'book_id';
    //public $timestamps = false;
    
    use Sluggable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'description', 'ISBN', 'pages', 'published_at', 'language_id', 'author_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    /**
     * 
     * @return type
     */
    public function author(){
        return $this->belongsTo('App\Models\Author', 'author_id', 'author_id');
    }
    
    /**
     * 
     * @return type
     */
    public function language(){
        return $this->belongsTo('App\Models\Languages', 'language_id');
    }
}
