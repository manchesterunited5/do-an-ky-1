<?php

namespace App\Http\Controllers\manager;

use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Controllers\Controller;
use App\specialize;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SpecializeController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    function getAllSpecialize(){
        $specializes = new Specialize();
        $specializes = $specializes->getAllSpecialize();
        $idHidden = -1;
        return view('manager/views/specialize/index'
            ,['specializes'=>$specializes,'hiddenId'=>$idHidden]);
    }
    //responsible for update and delete in same form
    function addOrUpdateSpecialize(Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $name = Str::ucfirst($request->input('name'));
        $id = (int)$request->get('id');
        //check specialize name exist
        if($this->commonFunction->isValueExist('name', $name, specialize::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error','This specialize name already exist',$request, route('admin-get-specialize'));
        //add case
        if($id==-1){
            $specialize = new Specialize();
            $this->modelFunction->addOrUpdateModel($specialize,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Add specialize successfully',$request, route('admin-get-specialize'));
        }
        //update case
        else{
            $specialize = Specialize::findOrFail((int)$request->input('id'));
            $this->modelFunction->addOrUpdateModel($specialize,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Update specialize successfully',$request, route('admin-get-specialize'));
        }
    }
    function deleteSpecialize($id,Request $request){
        $this->commonFunction = new CommonFunction();
        specialize::destroy($id);
        return $this->commonFunction->handleNotifyAndRedirect('success','Delete specialize successfully',$request, route('admin-get-specialize'));
    }
}
