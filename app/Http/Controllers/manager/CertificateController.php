<?php

namespace App\Http\Controllers\manager;

use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Controllers\Controller;
use App\certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    function getAllCertificate(){
        $certificates = new Certificate();
        $certificates = $certificates->getAllCertificate();
        $idHidden = -1;
        return view('manager/views/certificate/index'
            ,['certificates'=>$certificates,'hiddenId'=>$idHidden]);
    }
    //responsible for update and delete in same form
    function addOrUpdateCertificate(Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $name = Str::ucfirst($request->input('name'));
        $id = (int)$request->get('id');
        //check certificate name exist
        if($this->commonFunction->isValueExist('name', $name, certificate::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error','This certificate name already exist',$request, route('admin-get-certificate'));
        //add case
        if($id==-1){
            $certificate = new Certificate();
            $this->modelFunction->addOrUpdateModel($certificate,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Add certificate successfully',$request, route('admin-get-certificate'));
        }
        //update case
        else{
            $certificate = Certificate::findOrFail((int)$request->input('id'));
            $this->modelFunction->addOrUpdateModel($certificate,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Update certificate successfully',$request, route('admin-get-certificate'));
        }
    }
    function deleteCertificate($id,Request $request){
        $this->commonFunction = new CommonFunction();
        certificate::destroy($id);
        return $this->commonFunction->handleNotifyAndRedirect('success','Delete certificate successfully',$request, route('admin-get-certificate'));
    }
}
