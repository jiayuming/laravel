<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table='pages';
    protected $fillable=['class_id','title','keywords','describe','content','uploadpic','author','create_time'];

    public function belongsToClass(){
        return $this->belongsTo('App\Model\Pagesclass','class_id');
    }
}
