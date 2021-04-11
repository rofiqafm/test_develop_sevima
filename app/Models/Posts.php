<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Posts extends Model
{
    use Likeable;

    protected $table = "posts";
    
    /**
     * one to many ke tabel user
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * One to many ke tabel posts
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
