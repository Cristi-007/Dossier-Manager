<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\PostDec;

use App\Models\Subdivision;

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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';


Route::get('/addDossier', [App\Http\Controllers\DossierController::class, 'dataRegisterPrepare'])->middleware('auth')->name('NewDossiser');
Route::get('/viewDossier', [App\Http\Controllers\DossierController::class, 'showDossierList'])->middleware('auth')->name('ShowDossierList');
Route::post('/addDossier', [App\Http\Controllers\DossierController::class, 'register'])->name('RegisterNewDossier');
Route::delete('/viewDossier', [App\Http\Controllers\DossierController::class, 'delete']);
Route::put('/viewDossier', [App\Http\Controllers\DossierController::class, 'update']);


Route::get('/employee_manager_view', [App\Http\Controllers\EmployeeController::class, 'show'])->name('ShowEmployeeList');
Route::post('/employee_manager_register', [App\Http\Controllers\EmployeeController::class, 'register'])->name('RegisterEmployee');
Route::view('/employee_manager_register', 'pages.EmployeeManagement.employeeRegister', ['notificationCheck' => 'free'])->name('RegisterEmployeeView');
Route::put('/employee_manager_view', [App\Http\Controllers\EmployeeController::class, 'update']);


Route::view('/nomenclatures_view', 'pages.NomenclaturesManagement.nomenclatureView')->name('NomenclaturesView');
Route::get('/nomenclatures_register/{table}', function($table) {

    if ($table != 'Unitati') {
        return view('pages.NomenclaturesManagement.nomenclatureRegister', ["table" => $table, 'notificationCheck' => 'free']);
    } else {
        $subdivisions = Subdivision::all();
        return view('pages.NomenclaturesManagement.nomenclatureRegister', ["table" => $table, 'notificationCheck' => 'free', 
                    'subdivisions'=>$subdivisions]);
    }
    
})->name('NomenclaturesRegisterView')->where('table', '[\w\s\-_\/]+');
Route::post('/nomenclatures_register', [App\Http\Controllers\NomenclaturesController::class, 'register'])->name('RegisterNomenclature');



// routes for ajax requests
Route::post('departments', [App\Http\Controllers\DossierController::class, 'getDepartments']);
Route::post('showDetailedDossier', [App\Http\Controllers\DossierController::class, 'getDetailedDossierData']);
Route::post('search', [App\Http\Controllers\DossierController::class, 'search']);
Route::post('pagination', [App\Http\Controllers\DossierController::class, 'pagination']);
Route::post('expertDetailedData', [App\Http\Controllers\EmployeeController::class, 'getDetailedEmployeeData']);
Route::post('showNomenclature', [App\Http\Controllers\NomenclaturesController::class, 'show']);
Route::post('getNomenclatureDetailedData', [App\Http\Controllers\NomenclaturesController::class, 'getNomenclatureData']);


// INFO
// middleware('auth')  ----  ruta ce contine acest tag se deshide doar daca este efectuata logarea