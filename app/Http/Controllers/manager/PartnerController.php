<?php

namespace App\Http\Controllers\manager;

use App\partner;
use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    function getAllPartner(){
        $partners = new Partner();
        $partners = $partners->getAllPartner();
        $idHidden = -1;
        return view('manager/views/partner/index'
            ,['partners'=>$partners,'hiddenId'=>$idHidden]);
    }

    //responsible for update and delete in same form
    function addOrUpdatePartner(Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $name = Str::ucfirst($request->input('name'));
        $partnerAddress = $request->input('address_partner');
        $id = (int)$request->get('id');
        //check partner name exist
        if($this->commonFunction->isValueExist('name', $name, Partner::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error','Partner name already exist',$request, route('admin-get-partner'));
        if($this->commonFunction->isValueExist('address_partner', $partnerAddress, Partner::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error','This address partner already exist',$request, route('admin-get-partner'));
        //add case
        if($id==-1){
            $partner = new partner();
            $this->modelFunction->addOrUpdateModel($partner,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Add partner successfully',$request, route('admin-get-partner'));
        }
        //update case
        else{
            $partner = partner::findOrFail((int)$request->input('id'));
            $this->modelFunction->addOrUpdateModel($partner,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Update partner successfully',$request, route('admin-get-partner'));
        }
    }
    function deletePartner($id,Request $request){
        $this->commonFunction = new CommonFunction();
        partner::destroy($id);
        return $this->commonFunction->handleNotifyAndRedirect('success','delete partner successfully',$request, route('admin-get-partner'));
    }
}
