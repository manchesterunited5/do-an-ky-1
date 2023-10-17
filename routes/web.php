<?php

use App\AcademicLevel;
use App\Http\Controllers\manager\AcademicLevelController;
use App\Http\Controllers\manager\CertificateController;
use App\Http\Controllers\manager\ContractTypeController;
use App\Http\Controllers\manager\DepartmentController;
use App\Http\Controllers\manager\PartnerController;
use App\Http\Controllers\manager\PositionController;
use App\Http\Controllers\manager\RatingController;
use App\Http\Controllers\manager\SpecializeController;
use App\Rating;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('manager/views/index');
//});


Route::get('/admin/position', [PositionController::class, 'getAllPosition'])->name('admin-get-position');
Route::post('/admin/add-position', [PositionController::class, 'addOrUpdatePosition'])->name('admin-add-position');
Route::delete('/admin/delete-position/{id}', [PositionController::class, 'deletePosition'])->name('admin-delete-position');


Route::get('/admin/department', [DepartmentController::class, 'getAllDepartment'])->name('admin-get-department');
Route::post('/admin/add-department', [DepartmentController::class, 'addOrUpdateDepartment'])->name('admin-add-department');
Route::delete('/admin/delete-department/{id}', [DepartmentController::class, 'deleteDepartment'])->name('admin-delete-department');

Route::get('/admin/contract_type', [ContractTypeController::class, 'getAllContractType'])->name('admin-get-contract_type');
Route::post('/admin/add-contract_type', [ContractTypeController::class, 'addOrUpdateContractType'])->name('admin-add-contract_type');
Route::delete('/admin/delete-contract_type/{id}', [ContractTypeController::class, 'deleteContractType'])->name('admin-delete-contract_type');

Route::get('/admin/rating', [RatingController::class, 'getAllRating'])->name('admin-get-rating');
Route::post('/admin/add-rating', [RatingController::class, 'addOrUpdateRating'])->name('admin-add-rating');
Route::delete('/admin/delete-rating/{id}', [RatingController::class, 'deleteRating'])->name('admin-delete-rating');

Route::get('/admin/certificate', [CertificateController::class, 'getAllCertificate'])->name('admin-get-certificate');
Route::post('/admin/add-certificate', [CertificateController::class, 'addOrUpdateCertificate'])->name('admin-add-certificate');
Route::delete('/admin/delete-certificate/{id}', [CertificateController::class, 'deleteCertificate'])->name('admin-delete-certificate');

Route::get('/admin/partner', [PartnerController::class, 'getAllPartner'])->name('admin-get-partner');
Route::post('/admin/add-partner', [PartnerController::class, 'addOrUpdatePartner'])->name('admin-add-partner');
Route::delete('/admin/delete-partner/{id}', [PartnerController::class, 'deletePartner'])->name('admin-delete-partner');

Route::get('/admin/specialize', [SpecializeController::class, 'getAllSpecialize'])->name('admin-get-specialize');
Route::post('/admin/add-specialize', [SpecializeController::class, 'addOrUpdateSpecialize'])->name('admin-add-specialize');
Route::delete('/admin/delete-specialize/{id}', [SpecializeController::class, 'deleteSpecialize'])->name('admin-delete-specialize');

Route::get('/admin/academic_level', [AcademicLevelController::class, 'getAllAcademicLevel'])->name('admin-get-academic_level');
Route::post('/admin/academic_level/get-form-academic_level', [AcademicLevelController::class, 'addOrUpdateAcademicLevelView'])->name('admin-add-academic_level');
Route::post('/admin/academic_level/add-academic_level', [AcademicLevelController::class, 'addOrUpdateAcademicLevel'])->name('admin-update-academic_level');
Route::delete('/admin/delete-academic_level/{id}', [AcademicLevelController::class, 'deleteAcademicLevel'])->name('admin-delete-academic_level');
//Route::delete('/admin/academic_level/delete-academic_level/{id}',[AcademicLevelController::class,'deleteAcademicLevel']);
//Route::delete('/admin/delete-academic_level/{id}', 'manager\AcademicLevelController@deleteAcademicLevel');

//Route::match(['get', 'post'], '/admin/create/{id?}', [AcademicLevelController::class,'saveOrUpdate']);
