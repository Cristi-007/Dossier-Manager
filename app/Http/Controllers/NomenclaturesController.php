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

        if($table_name != 'subdivisions'){
            $data = DB::table($table_name)->get();

            foreach($data as $item) {
                $item->active == 0 ? $item->active = 'Inactiv' : $item->active = 'Activ';
            }
        } else {
            $data = DB::table('departments')
                        ->join('subdivisions', 'subdivision_id', '=', 'subdivisions_id')
                        ->select(['*', 'departments.active as active_department', 'subdivisions.active as active_subdivision',
                                'departments.created_at as department_created_at', 'subdivisions.created_at as subdivision_created_at'])
                        ->get();

            foreach($data as $item) {
                $item->active_department == 0 ? $item->active_department = 'Inactiv' : $item->active_department = 'Activ';
                $item->active_subdivisio == 0 ? $item->active_subdivisio = 'Inactiv' : $item->active_subdivisio = 'Activ';
            }
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
                        'abbreviation' => $validatedData['abbreviation'],
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
                        'abbreviation' => $validatedData['abbreviation'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);
                    break;
    
                case 'Genul expertizei':
                    $ReportType = ReportTypes::create([
                        'report_type' => $validatedData['report_type'],
                        'abbreviation' => $validatedData['abbreviation'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);
                    break;
    
                case 'Subdiviziuni / Unități':

                    $Subdivision = Subdivision::create([
                        'action_type' => $validatedData['action_type'],
                        'abbreviation' => $validatedData['abbreviation'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                    ]);


                    $Department = Department::create([
                        'department' => $validatedData['department'],
                        'abbreviation' => $validatedData['department_abbreviation'],
                        'active' => isset($_POST['active']) ? 1 : 0,
                        'subdivision_id' => $Subdivision['subdivisions_id']
                    ]);
                    break;
            }

               
            DB::commit();
            return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'EmployeeRegisterSuccess', 'table'=>$request['checker']]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'EmployeeRegisterError', 'table'=>$request['checker']]);

            // throw $ex; de prelucrat erorile
        }



    }

}
