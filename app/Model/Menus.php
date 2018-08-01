<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table='menus';
    protected $fillable=['name','parent_id','type','address','class_id','target','status'];
}
