<?php

namespace App;

use App\Http\CommonFunction\CommonFunction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademicLevel extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'image', 'degree_place', 'specialized', 'diploma_type', 'status'];
    protected $table = 'academic_level';
    function addAcademicLevel(Request $request)
    {
        $academicLevel = new AcademicLevel();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('manager/image'), $imageName);
            $imagePath = 'manager/image/' . $imageName;
        }
        $this->addOrUpdateAcademicLevel($imagePath, $academicLevel, $request);
    }

    function updateAcademicLevel(Request $request)
    {
        $academicLevel = AcademicLevel::findOrFail((int)$request->input('id'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('manager/image'), $imageName);
            $imagePath = 'manager/image/' . $imageName;
        }
        else {
            $imagePath = $academicLevel->image;
        }
        $this->addOrUpdateAcademicLevel($imagePath, $academicLevel, $request);
    }

    function getAllAcademicLevel($isSupperAdmin=null)
    {
        if($isSupperAdmin){
            return DB::table('academic_level')
                ->leftJoin('employee', 'academic_level.employee_id', '=', 'employee.id')
                ->whereNotNull('academic_level.deleted_at')
                ->select('academic_level.*', 'employee.full_name as employee_name')
                ->paginate(2);
        }
        return DB::table('academic_level')
            ->leftJoin('employee', 'academic_level.employee_id', '=', 'employee.id')
            ->whereNull('academic_level.deleted_at')
            ->select('academic_level.*', 'employee.full_name as employee_name')
            ->paginate(2);
    }


    function getAcademicLevelById($id){
       return AcademicLevel::findOrFail($id);
    }

    /**
     * @param string $imagePath
     * @param $academicLevel
     * @param Request $request
     * @return void
     */
    private function addOrUpdateAcademicLevel(string $imagePath, $academicLevel, Request $request): void
    {
        $academicLevel->name = $request->get('name');
        $academicLevel->image = $imagePath;
        $academicLevel->degree_place = $request->get('degree_place');
        $academicLevel->specialized = $request->get('specialized');
        $academicLevel->diploma_type = $request->get('diploma_type');
        if ($request->has('status'))
            $academicLevel->status = 1;
        else
            $academicLevel->status = 0;
        $academicLevel->save();
    }
    function deleteAcademicLevel(string $id,Request $request){
        $commonFunction = new CommonFunction();
        AcademicLevel::destroy($id);
        return $commonFunction->handleNotifyAndRedirect('success','Delete academic level successfully',$request,'/admin/academic_level');
    }
}
