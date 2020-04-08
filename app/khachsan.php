<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khachsan extends Model
{
    //
    protected $table='diadiemdulich_khachsan_point';
    protected $primaryKey = 'gid';
    public $timestamps = false;
    public $incrementing = true;
}
