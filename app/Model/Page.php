<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table='page';
    protected $fillable=['title','keywords','describe','content','uploadpic','author','create_time'];
}
