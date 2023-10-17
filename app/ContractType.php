<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractType extends Model
{
    use SoftDeletes;
    protected $table="contract_type";
    protected $fillable = ['name', 'status','number_of_year_contract'];
    function getAllContractType(){
        return ContractType::all();
    }
}

