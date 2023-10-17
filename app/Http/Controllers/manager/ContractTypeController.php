<?php

namespace App\Http\Controllers\manager;

use App\ContractType;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContractTypeController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    function getAllContractType()
    {
        $contractTypes = new ContractType();
        $contractTypes = $contractTypes->getAllContractType();
        $idHidden = -1;
        return view('manager/views/contract_type/index'
            , ['contractTypes' => $contractTypes, 'hiddenId' => $idHidden]);
    }

    //responsible for update and delete in same form
    function addOrUpdateContractType(Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $name = Str::ucfirst($request->input('name'));
        $numberOfYearContract = (int)$request->input('number_of_year_contract');
        $id = (int)$request->get('id');
        //check contractType name and year of contract exist
        if ($this->commonFunction->isValueExist('name', $name, ContractType::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error',
                'This contract type name already exist', $request, route('admin-get-contract_type'));
        if ($this->commonFunction->isValueExist('number_of_year_contract', $numberOfYearContract, ContractType::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error',
                'Number of year contract already exist', $request, route('admin-get-contract_type'));
        //add case
        if ($id == -1) {
            $contractType = new contractType();
            $this->modelFunction->addOrUpdateModel($contractType,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success',
                'Add contract type successfully', $request, route('admin-get-contract_type'));
        } //update case
        else {
            //find contractType by id
            $contractType = contractType::findOrFail((int)$request->input('id'));
            $this->modelFunction->addOrUpdateModel($contractType,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success', 'Update contract type successfully', $request, route('admin-get-contract_type'));
        }
    }

    function deleteContractType($id, Request $request)
    {
        $this->commonFunction = new CommonFunction();
        ContractType::destroy($id);
        return $this->commonFunction->handleNotifyAndRedirect('success', 'Delete contract type successfully', $request, route('admin-get-contract_type'));
    }
}
