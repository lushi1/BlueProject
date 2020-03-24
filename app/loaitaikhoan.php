<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaitaikhoan extends Model
{
    protected $table='loaitaikhoan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
}
