<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeStatus extends Model
{
    protected $table = 'type_statuses';
    protected $fillable = ['name'];
    protected $guarded = ['id'];

    // Relacion uno a muchos TypeStatus con Status
    public function statuses()
    {
    	return $this->hasMany('App\Models\Status');
    }
}
