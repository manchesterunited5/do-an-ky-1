<?php

namespace App\Http\Controllers\manager;

use App\AcademicLevel;
use App\Certificate;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AcademicLevelController extends Controller
{

    function getAllAcademicLevel()
    {
        $listAcademicLevel = new AcademicLevel();
        $listAcademicLevel = $listAcademicLevel->getAllAcademicLevel();

        return view('manager/views/academic_level/index', ['listAcademicLevel' => $listAcademicLevel]);
    }

    function addOrUpdateAcademicLevelView(Request $request)
    {
        $formType = $request->get('formType');
        $academicLevel = new AcademicLevel();
        //add form
        if ($formType == 'add') {
            $idHidden = -1;
            return view(
                'manager/views/academic_level/AddAcademicLevel',
                ['hiddenId' => $idHidden, 'academicLevel' => $academicLevel]
            );
        }
        //update form
        else {
            $id = $request->get('id');
            $idHidden = $id;
            $findAcademicLevel = $academicLevel->getAcademicLevelById($id);
            return view(
                'manager/views/academic_level/AddAcademicLevel',
                ['hiddenId' => $idHidden, 'academicLevel' => $findAcademicLevel]
            );
        }
    }

    function addOrUpdateAcademicLevel(Request $request)
    {
        $commonFunction = new CommonFunction();
        $name = Str::ucfirst($request->input('name'));
        $id = (int)$request->get('id');
        //check certificate name exist
        if ($commonFunction->isValueExist('name', $name, AcademicLevel::class, $id))
            return $commonFunction->handleNotifyAndRedirect('error', 'This academic level name already exist', $request, route('admin-get-academic_level'));
        $academicLevel = new AcademicLevel();
        //add case
        if ($id == -1) {
            $academicLevel->addAcademicLevel($request);
            return $commonFunction->handleNotifyAndRedirect('success', 'Add academic level successfully', $request, route('admin-get-academic_level'));
        }
        //update case
        else {
            $academicLevel->updateAcademicLevel($request);
            return $commonFunction->handleNotifyAndRedirect('success', 'Update academic level successfully', $request, route('admin-get-academic_level'));
        }
    }

    private $commonFunction;
    function deleteAcademicLevel($id, Request $request)
    {
        $this->commonFunction = new CommonFunction();
        AcademicLevel::where('id', $id)->delete();
        return $this->commonFunction->handleNotifyAndRedirect('success', 'Delete position successfully', $request, route('admin-get-academic_level'));
    }

    //    function saveOrUpdate(Request $request,$id=null ){
    //
    //        $academicLevel = new AcademicLevel();
    //        if($id){
    //            $academicLevel = new AcademicLevel();
    //            $academicLevel =  $academicLevel->getAcademicLevelById($id);
    //        }
    //        return view("manager/views/academic_level/form",["data"=>$academicLevel]);
    //    }
}
