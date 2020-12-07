<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name', 'status_id'];
    protected $guarded = ['id'];

    //Relacion muchos a uno de Role y Status
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    //Relacion de Uno a muchos de Role y User
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
