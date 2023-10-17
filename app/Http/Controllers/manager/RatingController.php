<?php

namespace App\Http\Controllers\manager;

use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Controllers\Controller;
use App\rating;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RatingController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    function getAllRating(){
        $ratings = new Rating();
        $ratings = $ratings->getAllRating();
        $idHidden = -1;
        return view('manager/views/rating/index'
            ,['ratings'=>$ratings,'hiddenId'=>$idHidden]);
    }
    //responsible for update and delete in same form
    function addOrUpdateRating(Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $name = Str::ucfirst($request->input('name'));
        $id = (int)$request->get('id');
        //check rating name exist
        if($this->commonFunction->isValueExist('name', $name, rating::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error','This rating name already exist',$request, route('admin-get-rating'));
        //add case
        if($id==-1){
            $rating = new Rating();
            $this->modelFunction->addOrUpdateModel($rating,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Add rating successfully',$request, route('admin-get-rating'));
        }
        //update case
        else{
            $rating = Rating::findOrFail((int)$request->input('id'));
            $this->modelFunction->addOrUpdateModel($rating,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Update rating successfully',$request, route('admin-get-rating'));
        }
    }
    function deleteRating($id,Request $request){
        $this->commonFunction = new CommonFunction();
        rating::destroy($id);
        return $this->commonFunction->handleNotifyAndRedirect('success','Delete rating successfully',$request, route('admin-get-rating'));
    }
}
