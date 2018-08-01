<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pagesclass extends Model
{
    protected $table='pages_class';
    protected $fillable=['name','parent_id'];
    protected $primaryKey='class_id';


}
