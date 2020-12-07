<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','status_id'];
    protected $guarded = ['id'];

    //Relacion muchos a uno de Category y Status
    public function status()
    {
    	return $this->belongsTo('App\Models\Status');
    }

    //Relacion muchos a muchos de Catgeory y Movie
    public function movies()
    {
    	return $this->belongsToMany('App\Models\Movie');
    }
}
