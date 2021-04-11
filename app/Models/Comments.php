<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = "comments";

    /**
     * one to many ke tabel users
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * one to many ke tabel posts
     *
     * @return void
     */
    public function posts()
    {
        return $this->belongsTo('App\Models\Posts', 'post_id', 'id');
    }
}
