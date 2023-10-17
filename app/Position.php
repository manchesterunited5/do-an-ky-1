<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','status'];
    protected $table = 'position';
    function getAllPosition(){
        return Position::all();
    }
}
