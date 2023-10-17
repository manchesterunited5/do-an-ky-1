<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes;
    protected $table = "rating";
    protected $fillable = ['name','status'];
    function getAllRating(){
        return Rating::all();
    }
}
