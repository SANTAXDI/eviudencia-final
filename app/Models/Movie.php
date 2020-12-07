<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $fillable = ['name', 'description', 'user_id', 'status_id'];
    protected $guarded = ['id'];

    //Relacion muchos a muchos de Movie y Category
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    //Relacion muchos a uno de Movie y Status
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    //Relacion muchos a uno de Movie y User
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

     //Relacion muchos a muchos de Movie y Rental
     public function rentals()
     {
         return $this->belongsToMany('App\Models\Rental');
     }
}
