<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'quantity','status'];
    protected $table = 'department';
    function getAllDepartments(){
        return Department::all();
    }
}
