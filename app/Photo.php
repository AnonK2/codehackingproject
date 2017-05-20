<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['path'];
    protected $uploads = "/images/";

    public function users()
    {
        return $this->hasMany('App\User', 'path');
    }

    public function getPathAttribute($photo)
    {
        return $this->uploads . $photo;
    }
}
