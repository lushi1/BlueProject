<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class taikhoan extends Model
{
    //
    protected $table='taikhoan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tentaikhoan', 'email', 'matkhau','loaitaikhoan','google_id',
    ];
}
