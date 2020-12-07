<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rentals';
    protected $fillable = ['start_date', 'end_date', 'total', 'user_id', 'status_id'];
    protected $guarded = ['id'];

    //Relacion muchos a uno de Rental y Status
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    //Relacion muchos a muchos de Rental y Movie
    public function movies()
    {
        return $this->belongsToMany('App\Models\Movie');
    }
}
