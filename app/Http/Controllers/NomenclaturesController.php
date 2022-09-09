<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $item->created_at = date('Y-m-d', strtotime($item->created_at));
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
                return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'NomenclatureRegisterSuccess', 
                                'table'=>$request['checker']]);
            } else {
                return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'NomenclatureRegisterSuccess', 
                            'table'=>$request['checker'], 'subdivisions'=> Subdivision::all() ]);
            }
        } catch (\Exception $ex) {

                dd($ex);
            DB::rollBack();

            if ($request['checker'] != 'Unitati') {
                return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'NomenclatureRegisterError', 
                                'table'=>$request['checker']]);
            } else {
                return view('/pages.NomenclaturesManagement.nomenclatureRegister', ['notificationCheck' => 'NomenclatureRegisterError', 
                            'table'=>$request['checker'], 'subdivisions'=> Subdivision::all() ]);
            }
       
            // throw $ex; de prelucrat erorile
        }



    }


    public function update(Request $request) {

        if(isset($request['action_type'])) {
            try {
                $updatedData = DB::table('action_types')
                        ->where("action_types_id", $request['action_type_id'])
                        ->update([
                                "action_type" => $request["action_type"],
                                "abbreviation" => $request["abbreviation"],
                                "active" => $request["active"]
                        ]);
            } catch (\Exception $ex) {
                dd($ex);
            }
        
        }

        if(isset($request['examination_type'])) {
            try {
                $updatedData = DB::table('examination_types')
                        ->where("examination_types_id", $request['examination_type_id'])
                        ->update([
                                "examination_type" => $request["examination_type"],
                                "active" => $request["active"]
                        ]);
            } catch (\Exception $ex) {
                dd($ex);
            }
        }

        if(isset($request['expertise_type'])) {
            try {
                $updatedData = DB::table('expertise_types')
                        ->where("expertise_types_id", $request['expertise_type_id'])
                        ->update([
                                "expertise_type" => $request["expertise_type"],
                                "active" => $request["active"]
                        ]);
            } catch (\Exception $ex) {
                dd($ex);
            }
        }

        if(isset($request['object_type'])) {
            try {
                $updatedData = DB::table('object_types')
                        ->where("object_types_id", $request['object_type_id'])
                        ->update([
                                "object_type" => $request["object_type"],
                                "abbreviation" => $request["abbreviation"],
                                "active" => $request["active"]
                        ]);
            } catch (\Exception $ex) {
                dd($ex);
            }
        }

        if(isset($request['report_type'])) {
            try {
                $updatedData = DB::table('report_types')
                        ->where("report_types_id", $request['report_type_id'])
                        ->update([
                                "report_type" => $request["report_type"],
                                "abbreviation" => $request["abbreviation"],
                                "active" => $request["active"]
                        ]);
            } catch (\Exception $ex) {
                dd($ex);
            }
        }

        if(isset($request['subdivision'])) {
            try {
                $updatedData = DB::table('subdivisions')
                        ->where("subdivisions_id", $request['subdivision_id'])
                        ->update([
                                "subdivision" => $request["subdivision"],
                                "abbreviation" => $request["abbreviation"],
                                "active" => $request["active"]
                        ]);
            } catch (\Exception $ex) {
                dd($ex);
            }
        }

        if(isset($request['department'])) {
            try {
                $updatedData = DB::table('departments')
                        ->where("departments_id", $request['department_id'])
                        ->update([
                                "department" => $request["department"],
                                "abbreviation" => $request["abbreviation"],
                                "active" => $request["active"]
                        ]);
            } catch (\Exception $ex) {
                dd($ex);
            }
        }
        
        
        if($updatedData == 1) {
            $this->UpdateStatus = "NomenclatureUpdateSuccess";
        } else{
            $this->UpdateStatus = "NomenclatureUpdateError";
        }
        

        return view('pages.NomenclaturesManagement.nomenclatureView', ['UpdateStatus' => $this->UpdateStatus]);
    }


    public function getNomenclatureData() {
        $nomenclature_id = $_POST['item_id'];
        $DataBaseTable = $_POST['DBtable'];

        $data = DB::table($DataBaseTable)->whereRaw($DataBaseTable . '_id = ' . $nomenclature_id)->get();


        return $data ;
    }


}
