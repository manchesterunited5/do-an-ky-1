<?php

namespace App\Http\Controllers\manager;

use App\Http\CommonFunction\CommonFunction;
use App\Http\CommonFunction\ModelFunction;
use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PositionController extends Controller
{
    protected $commonFunction;
    protected $modelFunction;
    function getAllPosition(){
        $positions = new Position();
        $positions = $positions->getAllPosition();
        $idHidden = -1;
        return view('manager/views/position/index'
            ,['positions'=>$positions,'hiddenId'=>$idHidden]);
        // return redirect(route('get'));
    }
    //responsible for update and delete in same form
    function addOrUpdatePosition(Request $request)
    {
        $this->commonFunction = new CommonFunction();
        $this->modelFunction = new ModelFunction();
        $name = Str::ucfirst($request->input('name'));
        $id = (int)$request->get('id');
        //check position name exist
        if($this->commonFunction->isValueExist('name', $name, Position::class, $id))
            return $this->commonFunction->handleNotifyAndRedirect('error','This position name already exist',$request, route('admin-get-position'));
        //add case
        if($id==-1){
            $position = new Position();
            $this->modelFunction->addOrUpdateModel($position,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Add position successfully',$request, route('admin-get-position'));
        }
        //update case
        else{
            $position = Position::findOrFail((int)$request->input('id'));
            $this->modelFunction->addOrUpdateModel($position,$request);
            return $this->commonFunction->handleNotifyAndRedirect('success','Update position successfully',$request, route('admin-get-position'));
        }
    }
    function deletePosition($id,Request $request){
        $this->commonFunction = new CommonFunction();
        Position::destroy($id);
        return $this->commonFunction->handleNotifyAndRedirect('success','Delete position successfully',$request, route('admin-get-position'));
    }
}
