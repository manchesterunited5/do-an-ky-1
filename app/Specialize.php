<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialize extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','status'];
    protected $table = 'specialize';
    function getAllSpecialize(){
        return Specialize::all();
    }
}
