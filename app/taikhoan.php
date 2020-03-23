<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class taikhoan extends Model
{
    //
    protected $table='taikhoan';
    protected $primaryKey = 'gid';
    public $timestamps = false;
    public $incrementing = false;
}
