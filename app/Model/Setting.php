<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table='setting';
    protected $fillable=['title','keywords','description','site_icp','site_tongji','site_copyright','notice'];
}
