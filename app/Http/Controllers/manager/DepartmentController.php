<?php

namespace App\Http\Controllers\manager;

use App\Department;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    function getAllDepartment(){
        $departments = new Department();
        $departments = $departments->getAllDepartments();
        $idHidden = -1;
        return view('manager/views/department/index'
            ,['departments'=>$departments,'hiddenId'=>$idHidden]);
    }

    //responsible for update and delete in same form
    function addOrUpdateDepartment(Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $name = Str::ucfirst($request->input('name'));
        $id = (int)$request->get('id');
        //check Department name exist
        if($this->commonFunction->isValueExist('name', $name, Department::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error','This department name already exist',$request, route('admin-get-department'));
        //add case
        if($id==-1){
            $department = new Department();
            $this->modelFunction->addOrUpdateModel($department,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Add department successfully',$request, route('admin-get-department'));
        }
        //update case
        else{
            $department = Department::findOrFail((int)$request->input('id'));
            $this->modelFunction->addOrUpdateModel($department,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Update department successfully',$request, route('admin-get-department'));
        }
    }
    function deleteDepartment($id,Request $request){
        $this->commonFunction = new CommonFunction();
        Department::destroy($id);
        return $this->commonFunction->handleNotifyAndRedirect('success','delete department successfully',$request, route('admin-get-department'));
    }
}
