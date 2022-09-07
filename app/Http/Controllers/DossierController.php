<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DataValidationController;

use App\Models\Dossier;
use App\Models\CaseOfficer;
use App\Models\Department;
use App\Models\Subdivision;
use App\Models\ActionTypes;
use App\Models\ExpertiseTypes;
use App\Models\Expert;
use App\Models\Report;
use Illuminate\Support\Facades\Route;


class DossierController extends Controller
{
    protected $UpdateStatus = 'free';
    protected $DeleteStatus = 'free';


    public function dataRegisterPrepare() {
        $subdivisions = Subdivision::all()->where("subdivisions_id", "!=", 1)->sortBy('subdivision');
        $actionTypes = ActionTypes::all();
        $expertiseTypes = ExpertiseTypes::all();
        $experts = Expert::all()->sortBy('novice');

        if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
            $notificationCheck = "RegisterSuccess";
        } else {
            $notificationCheck = "free";
        };

        return view('/pages.DossierManagement.dossierRegister', ['subdivisions' => $subdivisions, 
                                            'actionTypes' => $actionTypes, 
                                            'expertiseTypes' => $expertiseTypes,
                                            'experts' => $experts,
                                            'notificationCheck' => $notificationCheck] );
    }


    public function register(Request $request) {
        $NewDossier = new Dossier();
        $NewCaseOfficer = new CaseOfficer();
        $DataValidation = new DataValidationController();
        $NewDepartment = new Department();

        $validator = $DataValidation->dossierAddValidation($request);
        if ($validator->fails()) {
            return redirect('addDossier')
                        ->withErrors($validator)
                        ->withInput();
        }
        $validatedData = $validator->validated();

        $dossierNumber = $validatedData['dossier_number'];
        $dossierDate = $request['dossier_date'];
        $requestNo = $request['request_no'];
        $requestDate = $request['request_date'];
        // -------------------------------------------
        $caseType = $request['case_type'];
        $caseNo = $request['case_no'];
        // -------------------------------------------
        $packageNo = $request['package_no'];
        $storageLocation = $request['storage_location'];
        // -------------------------------------------
        $expertiseType = $request['expertise_type'];
        $expertiseDeadline = $request['expertise_deadline'];
        switch ($request['dossier_state']) {
            case 1:
                $dossierState = 'Camera de păstrare';
                break;
            case 2:
                $dossierState = 'În executare';
                break;
            case 3:
                $dossierState = 'Executat';
                break;
        }
        $expert = $request['expert'];
        $notes = $request['notes'];
        
    
        if($request -> hasFile('file')) {
            $file = $request -> file('file');
            $file_ext = $file -> getClientOriginalExtension();
            $file_name = date("Y_m_d") . '_' . $dossierNumber . '.' . $file_ext;
            $file_folder = public_path('uploaded_files/');
            $file -> move($file_folder, $file_name);

            $NewDossier -> scanned_request = $file_name;
        } else { }
        

        // add case_officer or select case_officer_id
        try {
            $caseOfficerName = $request['case_officer_name'];
            $caseOfficerSurname = $request['case_officer_surname'];

            $noDepartments = Department::all()->where("subdivision_id", "=", $request['subdivision']);

            if($request['department'] === '0') {
                if(count($noDepartments) !== 0){
                    foreach($noDepartments as $department) {
                        $departmentID = $department['departments_id'];
                    }
                } else {
                    $NewDepartment -> subdivision_id = $request['subdivision'];
                    $NewDepartment -> department = '';
                    $NewDepartment -> abbreviation = 'NoDepartment';
                    $NewDepartment->save();

                    $departmentID = Department::latest('departments_id')->first() -> departments_id;
                }
            } else {
                $departmentID = $request['department'];
            }

            // check if exists same data
            $ExistingCaseOfficer = CaseOfficer::where([
                ['officer_name', '=', strtoupper($caseOfficerName)],
                ['officer_surname', '=', strtoupper($caseOfficerSurname)],
                ['department_id', '=', $departmentID]
            ])->get();


            if(count($ExistingCaseOfficer) == 0){
                $NewCaseOfficer -> officer_name = strtoupper($caseOfficerName);
                $NewCaseOfficer -> officer_surname = strtoupper($caseOfficerSurname);
                $NewCaseOfficer -> department_id = $departmentID;

                $NewCaseOfficer -> save();

                $CaseOfficerID = CaseOfficer::latest('case_officers_id')->first() -> case_officers_id; // getting ID of last saved officer
            } else {
                $CaseOfficerID = $ExistingCaseOfficer[0]['case_officers_id'];  // getting ID of existing officer
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            //throw $th;
        }


        $NewDossier -> subdivision_code = '34/12/1-C-';
        $NewDossier -> expertise_department = 'SEI';
        $NewDossier -> case_officer_id = $CaseOfficerID;
        $NewDossier -> dossier_number = $dossierNumber;
        $NewDossier -> dossier_date = $dossierDate;
        $NewDossier -> request_number = $requestNo;
        $NewDossier -> request_date = $requestDate;

        $NewDossier -> action_type_id = $caseType;
        $NewDossier -> action_number = $caseNo;
        
        $NewDossier -> received_packages_number = $packageNo;
        $NewDossier -> location = strtoupper($storageLocation);

        $NewDossier -> expertise_type_id = $expertiseType;
        $NewDossier -> expertise_deadline = $expertiseDeadline;
        $NewDossier -> dossier_state = $dossierState;
        $NewDossier -> expert_id = $expert;
        $NewDossier -> notes = strtoupper($notes);

        $NewDossier -> save();

        return $this->dataRegisterPrepare();
    }


    public function update(Request $request) {
        $oldDossier = Dossier::all()->where("dossiers_id", "=", $request["dossier_id"]);

        // valiadarea datelor????
        foreach($oldDossier as $key =>$dossier) {
            $oldCaseOfficer = CaseOfficer::all()->where("case_officers_id", "=", $dossier->case_officer_id);
        }

        $updatedDossier = DB::table('dossiers')
                    ->where('dossiers_id', $request["dossier_id"])
                    ->update([
                        'dossier_number' => $request["dossier_number"],
                        'dossier_date' => $request["dossier_date"],
                        'request_number' => $request["request_no"],
                        'request_date' => $request["request_date"],
                        'action_number' => $request["case_no"],
                        'received_packages_number' => $request["package_no"],
                        'expertise_deadline' => $request["expertise_deadline"],
                        'dossier_state' => $request["dossier_state"] === '1' ? 'Camera de păstrare' : 
                                                ($request["dossier_state"] === '2' ? 'În executare' :
                                                    ($request["dossier_state"] === '3' ? 'Executat' : '')),
                        'notes' => ($request["notes"] === null ? '' : $request["notes"]),
                        'location' => $request["storage_location"],
                        // 'case_officer_id' => $formData[""],
                        'action_type_id' => $request["case_type"],
                        // 'report_id' => $formData[""],
                        'expertise_type_id' => $request["expertise_type"],
                        'expert_id' => $request["expert"]
                    ]);


        // check the existence of the officer ???
        foreach($oldCaseOfficer as $key=>$officer) {
            $oldCaseOfficerKey = $key;
            
        $updatedCaseOfficer = DB::table('case_officers')
                ->where('case_officers_id', $officer -> case_officers_id)
                ->update([
                    'officer_name' => $request["case_officer_name"],
                    'officer_surname' => $request["case_officer_surname"],
                    'department_id' => $request["department"] ]);
        }

        
        if($updatedDossier == 1) {
            $this->UpdateStatus = "UpdateSuccess";
        } else{
            $this->UpdateStatus = "UpdateError";
        }

        return $this->showDossierList($request);
    }


    public function delete(Request $req) {
        $dossierID = $req['dossier_id'];

        $deleted = DB::table('dossiers')
                        ->where('dossiers_id', '=', $dossierID)
                        ->delete();


        if($deleted == 1) {
            $this->DeleteStatus = "DeleteSuccess";
        } else{
            $this->DeleteStatus = "DeleteError";
        }
        
        return $this-> showDossierList($req);
    }


    public function search(Request $request) {
        $searchData = $request->search_data;

        if($searchData == '') {
            return $this-> showDossierList($request);
        } else {
            $DbResults = $this->getDossierPartialData("(dossier_number like '%$searchData%') or " .
                                                "(action_number like '%$searchData%') or " .
                                                "(location like '%$searchData%') or " .
                                                "(dossier_date like '%$searchData%') or " . 
                                                "(CONCAT(`case_officers`.`officer_name`,' ', `case_officers`. `officer_surname`) like '%$searchData%') or " .
                                                "(dossier_state like '%$searchData%') or " .
                                                "(CONCAT(`experts`.`expert_name`,' ', `experts`. `expert_surname`) like '%$searchData%') or " . 
                                                "(departments.abbreviation like '%$searchData%') or " . 
                                                "(subdivisions.abbreviation like '%$searchData%') or " .
                                                "(action_types.action_type like '%$searchData%')", $request->entryPerPage);

            $routeAction = substr(Route::currentRouteAction(), strpos(Route::currentRouteAction(), '@')+1);

            return view('pages.DossierManagement.dossierPaginatedTable', ['dossiers' => $DbResults, 'DeleteStatus' => 'free', 
                    'UpdateStatus' => 'free', 'routeAction'=>$routeAction])->render();
        }
    }


    public function getDepartments(){
        $id = $_POST['subdivision_id'];
        $departments = Department::all()->where("subdivision_id", "=", $id)->sortBy('abbreviation');
        return $departments;
    }


    public function showDossierList(Request $req) {
        if(isset($_GET['entryPerPage'])) {
            $entryPerPage = $_GET['entryPerPage'];
        } else {
            $entryPerPage = 10;
        }

        $results = $this->getDossierPartialData("1", $entryPerPage);
        $routeAction = substr(Route::currentRouteAction(), strpos(Route::currentRouteAction(), '@')+1);
        
        switch ($routeAction) {
            case 'update':
                if($req->ajax() ) {
                    return view('pages.DossierManagement.dossierPaginatedTable', ['dossiers' => $results, 'DeleteStatus' => 'free', 
                                'UpdateStatus' => $this->UpdateStatus, 'routeAction'=>$routeAction ])->render();
                }
                return view('pages.DossierManagement.dossierView', ['dossiers' => $results, 'DeleteStatus' => 'free', 
                            'UpdateStatus' => $this->UpdateStatus, 'routeAction'=>$routeAction]);

            case 'delete':
                if($req->ajax() ) {
                    return view('pages.DossierManagement.dossierPaginatedTable', ['dossiers' => $results, 'DeleteStatus' => $this->DeleteStatus, 
                                'UpdateStatus' => 'free', 'routeAction'=>$routeAction])->render();
                }
                return view('pages.DossierManagement.dossierView', ['dossiers' => $results, 'DeleteStatus' => $this->DeleteStatus, 
                            'UpdateStatus' => 'free', 'routeAction'=>$routeAction]);

            default:
                if($req->ajax() ) {
                    return view('pages.DossierManagement.dossierPaginatedTable', ['dossiers' => $results, 'DeleteStatus' => 'free', 
                    'UpdateStatus' => 'free', 'routeAction'=>$routeAction])->render();
                }

                return view('pages.DossierManagement.dossierView', ['dossiers' => $results, 'DeleteStatus' => 'free', 
                            'UpdateStatus' => 'free', 'routeAction'=>$routeAction]);
        }
 
    }


    public function getDetailedDossierData() {
        $dossierID = $_POST['dossier_id'];

        $dossier = DB::table('dossiers')
                    ->join('case_officers', 'dossiers.case_officer_id', '=', 'case_officers.case_officers_id')
                    ->join('reports', 'dossiers.report_id', '=', 'reports.reports_id')
                    ->join('departments', 'case_officers.department_id', '=', 'departments.departments_id')
                    ->select('*')
                    ->where('dossiers.dossiers_id', '=', $dossierID)
                    ->get();

  
        $subdivisions = Subdivision::all();
        $actionTypes = ActionTypes::all();
        $expertiseTypes = ExpertiseTypes::all();
        $experts = Expert::all();
        $departments = Department::all()->where("subdivision_id", "=", $dossier[0]->subdivision_id);

        $newdata = array('data' => $dossier, 'subdivisions'=>$subdivisions, 'departments'=>$departments,
                        'actionTypes' =>$actionTypes, 'expertiseTypes' => $expertiseTypes, 'experts' =>$experts);

        return $newdata;
    }


    public function getDossierPartialData($where, $entry) {
        $data = DB::table('dossiers')
                ->join('case_officers', 'dossiers.case_officer_id', '=', 'case_officers.case_officers_id')
                ->join('departments', 'case_officers.department_id', '=', 'departments.departments_id')
                ->join('subdivisions', 'departments.subdivision_id', '=', 'subdivisions.subdivisions_id')
                ->join('action_types', 'dossiers.action_type_id', '=', 'action_types.action_types_id')
                ->join('experts', 'experts.experts_id', '=', 'dossiers.expert_id')
                ->select(['dossiers.dossiers_id', 'dossiers.dossier_number', 'dossiers.dossier_date', 
                            'dossiers.action_number', 'dossiers.dossier_state', 'dossiers.location',
                            'action_types.action_type', 'subdivisions.abbreviation as subdivision_abbreviation',
                            'departments.abbreviation as department_abbreviation', 'departments.department', 'subdivisions.subdivision',
                            DB::raw("CONCAT(`case_officers`.`officer_name`,' ', `case_officers`. `officer_surname`) as case_officer"),
                            DB::raw("CONCAT(`experts`.`expert_name`,' ', `experts`. `expert_surname`) as expert") ])
                ->whereRaw($where)
                ->orderBy('dossier_number', 'asc')
                ->paginate($entry);

        foreach($data as $item) {
            $item->dossier_state = ucwords(strtolower($item->dossier_state));
            $item->action_type = ucwords(strtolower($item->action_type));
            $item->case_officer = ucwords(strtolower($item->case_officer));
            $item->expert = ucwords(strtolower($item->expert));
        }

        return $data;
    }
}
