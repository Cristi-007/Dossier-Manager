<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataValidationController;

use App\Models\ActionTypes;
use App\Models\Department;
use App\Models\ExaminationTypes;
use App\Models\ExpertiseTypes;
use App\Models\ObjectTypes;
use App\Models\ReportTypes;
use App\Models\Subdivision;

class NomenclaturesController extends Controller
{
    protected $UpdateStatus = 'free';
    protected $DeleteStatus = 'free';


    public function show() {
        $table_name = $_POST['table_name'];
        $data = DB::table($table_name)->get();

        foreach($data as $item) {
            $item->active == 0 ? $item->active = 'Inactiv' : $item->active = 'Activ';
        }

        return $data;
    }


    public function register(Request $request) {
        $DataValidation = new DataValidationController();

        $validator = $DataValidation->nomenclatureValidation($request);
        if ($validator->fails()) {
            return redirect('nomenclatures_register/'. $request['checker'])
                        ->withErrors($validator)
                        ->withInput();
        }
        $validatedData = $validator->validated();

        try {
            DB::beginTransaction();

            switch ($request['checker']) {
                case 'Temei examinare / Tipul cauzei':
                    $ActionType = ActionTypes::create([
                        'action_type' => $validatedData['action_type'],
                        'abbreviation' => $request['abbreviation'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);
                    break;
                
                case 'Tipul examinării':
                    $ExaminationType = ExaminationTypes::create([
                        'examination_type' => $validatedData['examination_type'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);
                    break;
    
                case 'Clasificarea expertizei':
                    $ExpertiseType = ExpertiseTypes::create([
                        'expertise_type' => $validatedData['expertise_type'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);
                    break;
    
                case 'Tipul obiectului':
                    $ObjectType = ObjectTypes::create([
                        'object_type' => $validatedData['object_type'],
                        'abbreviation' => $request['abbreviation'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);
                    break;
    
                case 'Genul expertizei':
                    $ReportType = ReportTypes::create([
                        'report_type' => $validatedData['report_type'],
                        'abbreviation' => $request['abbreviation'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);
                    break;
    
                case 'Subdiviziuni':
                    $Subdivision = Subdivision::create([
                        'subdivision' => $validatedData['subdivision'],
                        'abbreviation' => $request['abbreviation'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);

                    $dep = Department::create([
                        'department' => null,
                        'abbreviation' => null,
                        'active' => 1,
                        'subdivision_id' => $Subdivision['id']
                    ]);
                    break;

                case 'Unitati':
                    $existingDepartment = Department::all()->where('subdivision_id', '=', $validatedData['subdivision_select']);

                    if(count($existingDepartment) > 1 ) {
                        $Department = Department::create([
                            'department' => $request['department'],
                            'abbreviation' => $request['abbreviation'],
                            'active' => isset($_POST['active']) ? 1 : 0,
                            'subdivision_id' => $validatedData['subdivision_select']
                        ]);
                    } else {
                        foreach ($existingDepartment as $item) {
                            if(is_null($item['department']) && is_null($item['abbreviation'])) {

                                $updatedDepartment = DB::table('departments')
                                    ->where('departments_id','=', $item['departments_id'])
                                    ->update([
                                        'department' => $request['department'],
                                        'abbreviation' => $request['abbreviation'],
                                        'active' => isset($_POST['active']) ? 1 : 0 ]);
                            } else {
                                $Department = Department::create([
                                    'department' => $request['department'],
                                    'abbreviation' => $request['abbreviation'],
                                    'active' => isset($_POST['active']) ? 1 : 0,
                                    'subdivision_id' => $validatedData['subdivision_select']
                                ]);
                            }
                        }
                    }

                    break;
            }
            DB::commit();

            if ($request['checker'] != 'Unitati') {
                return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'EmployeeRegisterSuccess', 
                                'table'=>$request['checker']]);
            } else {
                return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'EmployeeRegisterSuccess', 
                            'table'=>$request['checker'], 'subdivisions'=> Subdivision::all() ]);
            }
        } catch (\Exception $ex) {

                dd($ex);
            DB::rollBack();

            if ($request['checker'] != 'Unitati') {
                return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'EmployeeRegisterError', 
                                'table'=>$request['checker']]);
            } else {
                return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'EmployeeRegisterError', 
                            'table'=>$request['checker'], 'subdivisions'=> Subdivision::all() ]);
            }
       
            // throw $ex; de prelucrat erorile
        }



    }



    public function getNomenclatureData() {
        $nomenclature_id = $_POST['item_id'];
        $DataBaseTable = $_POST['DBtable'];

        $data = DB::table($DataBaseTable)->whereRaw($DataBaseTable . '_id = ' . $nomenclature_id)->get();

        return $data ;
    }


}
