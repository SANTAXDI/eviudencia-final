<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['name', 'type_status_id'];
    protected $guarded = ['id'];

    //Relacion Muchos a Uno de Status a TypeStatus 
    public function typeStatus()
    {
        return $this->belongsTo('App\Models\TypeStatus');
    }

    //Relacion Uno a muchos de Status y Category
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    //Relacion de Uno a muchos de Status y Movie
    public function movies()
    {
        return $this->hasMany('App\Models\Movie');
    }

    //Relacion Uno a muchos de Status y User
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    //Relacion Uno a muchos de Status y roles
    public function roles()
    {
        return $this->hasMany('App\Models\Role');
    }

    //Relacion Uno a muchos de Status y Rental
    public function rentals()
    {
        return $this->hasMany('App\Models\Rental');
    }
}
