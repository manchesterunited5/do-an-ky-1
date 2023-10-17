<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'quantity','address_partner','status'];
    protected $table = 'partner';
    function getAllPartner(){
        return Partner::all();
    }
}
