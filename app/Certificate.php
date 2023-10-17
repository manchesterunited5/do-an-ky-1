<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','status'];
    protected $table = 'certificate';
    function getAllCertificate(){
        return Certificate::all();
    }
}
