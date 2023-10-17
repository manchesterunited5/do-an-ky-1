<?php

namespace App\Http\CommonFunction;

use App\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommonFunction
{
    function handleNotifyAndRedirect($alertType,$message,Request $request,$redirectRoute){
        $request->session()->flash('message',$message);
        $request->session()->flash('alert-type',$alertType);
        return redirect($redirectRoute);
    }
    function isValueExist($keyCheckExist,$valueCheckExist,$modelName, $excludeId = null)
    {
        $query = $modelName::where($keyCheckExist, $valueCheckExist);
        if (!is_null($excludeId)) {
            $query->where('id', '!=', $excludeId);
        }
        return $query->exists();
    }
}
