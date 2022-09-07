<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;
use Illuminate\Validation\Rule as Rule;
use Illuminate\Validation\Rules;

class DataValidationController extends Controller
{


    public function dossierAddValidation(Request $request) {

        $validator = Validator::make($request->all(), 
            [
                "subdivision" => ['required', function ($attribute, $value, $fail) use ($request){ 
                    if($value == 0) { $fail('Selectați instituția.'); } 
                }],
                "department" =>['required_if:subdivision,<,1',
                function ($attribute, $value, $fail) use ($request){
                    if($request->subdivision != 0) {
                        $departments = Department::all()->where("subdivision_id", "=", $request->subdivision);
                            foreach($departments as $item){
                                if($item['abbreviation'] === 'NoDepartment') {
                                    //* subdiviziunea nu are utitati
                                } else {
                                    if($value == 0){
                                        $fail('Selectați unitatea.');
                                    }
                                }
                            } 
                    }
                }, ],
                "case_officer_name" => ['required', 'max:255'],
                "case_officer_surname" => ['required', 'max:255'],
                "dossier_number" => 'required',
                "dossier_date" =>  [function ($attribute, $value, $fail) use ($request){ }],
                "request_no" => 'required',
                "request_date" =>  [function ($attribute, $value, $fail) use ($request){ }],
                "case_type" => [function ($attribute, $value, $fail) use ($request){ 
                    if($value == 0) { $fail('Selectați temeiul examinării.'); } 
                }],
                "case_no" => 'required',
                "package_no" => ['required', 'gt:0'],
                "storage_location" => 'required',
                "expertise_type" => ['required', function ($attribute, $value, $fail) use ($request){ 
                    if($value == 0) { $fail('Selectați tipul expertizei.'); } 
                }],
                "expertise_deadline" => 'required',
                "dossier_state" => 'required',
                "expert" => ['required', function ($attribute, $value, $fail) use ($request){ 
                    if($value == 0) { $fail('Selectați expertul.'); } 
                }],
                "file" => ['nullable', 'mimes:pdf, PDF'],
                "notes" => 'nullable'
            ], 
        
            [
                'required' => "Cîmpul :attribute este obligatoriu.",
                'mimes' => ':attribute trebue sa fie de tip: :values.',
                'gt' => [
                    'array' => ':attribute trebuie să aibă mai mult decât :value elemente.',
                    'file' => ':attribute trebue să fie mai mare decât :value kilobytes.',
                    'numeric' => ':attribute trebue să fie mai mare decât :value.',
                    'string' => ':attribute trebue să conțină mai mult decât :value caractere.',
                ],
                'max' => [
                    'array' => ':attribute nu trebue sa aibă mai mult de :max elemente.',
                    'file' => ':attribute nu trebuie să fie mai mare de :max kilobytes.',
                    'numeric' => ':attribute nu trebuie să fie mai mare decât :max.',
                    'string' => ':attribute nu trebuie să fie mai mare decât :max caractere.',
                ],
            ],
            [
                'subdivision' => '"Instituție"',
                'department' => '"Unitate"',
                'file' => 'Fișierul încărcat',
                'case_officer_name' => '"Nume ordonator"',
                'case_officer_surname' => '"Prenume ordonator"',
                'dossier_number' => '"Număr dosar"',
                'dossier_date' => '"Data dosar"',
                'request_no' => '"Număr soicitare"',
                'request_date' => '"Data solicitării"',
                'case_type' => '"Temei examinare"',
                'case_no' => '"Număr cauză"',
                'package_no' => '"Număr pachete"',
                'storage_location' => '"Locația de păstrare"',
                'expertise_type' => '"Tipul expertizei"',
                'expertise_deadline' => '"Termen"',
                'dossier_state' => '"Stare dosar"',
                'expert' => '"Expert"',
                'notes' => '"Detalii / Note"'
            ]
        );
        return $validator;
    }


    public function employeeValidation(Request $request) {
        $validator = Validator::make($request->all(), 
        [
            "expert_name" => 'required',
            "expert_surname" => 'required',
            "function" => 'required',
            "user_name" => ['required', 'string', 'max:255'],
            "username" => ['required', 'string', 'max:255', 'unique:users'],
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "password" => ['required', Rules\Password::min(8)
                                                    ->letters()
                                                    ->mixedCase()
                                                    ->numbers()
                                                    ->symbols()],
            "user-accesstype" => ['required', function ($attribute, $value, $fail) use ($request){ 
                if($value == '0' ) { $fail('Cîmpul "Tipul de acces în sistem" este obligatoriu.');; } 
            }]
        ], 
        
        [
            'required' => "Cîmpul :attribute este obligatoriu.",
        ],
        [
            'expert_name' => '"Nume expert"',
            'expert_surname' => '"Prenume expert"',
            'function' => 'Funcția',
            'user_name' => '"Nume"',
            'username' => '"Nume de utilizator (Username)"',
            'email' => '"Email"',
            'password' => '"Password / Parola"',
            'user-accesstype' => '"Tipul de acces în sistem"'
        ]
    );
    
    return $validator;
    }


    public function nomenclatureValidation(Request $request) {
        switch ($request['checker']) {
            case 'Temei examinare / Tipul cauzei':
                    $validator = Validator::make($request->all(), 
                    [ "action_type" => 'required' ], 
                    [ 'required' => "Cîmpul :attribute este obligatoriu." ],
                    [ 'action_type' => '"Tip cauză"' ] );
                break;
            
            case 'Tipul examinării':
                    $validator = Validator::make($request->all(), 
                    [ "examination_type" => 'required' ], 
                    [ 'required' => "Cîmpul :attribute este obligatoriu." ],
                    [ 'examination_type' => '"Tip examinare"'] );
                break;

            case 'Clasificarea expertizei':
                    $validator = Validator::make($request->all(), 
                    [ "expertise_type" => 'required' ], 
                    [ 'required' => "Cîmpul :attribute este obligatoriu." ],
                    [ 'expertise_type' => '"Clasificare expertiză"'] );
                break;

            case 'Tipul obiectului':
                    $validator = Validator::make($request->all(), 
                    [ "object_type" => 'required' ], 
                    [ 'required' => "Cîmpul :attribute este obligatoriu." ],
                    [ 'object_type' => '"Tip obiect"' ] );
                break;

            case 'Genul expertizei':
                    $validator = Validator::make($request->all(), 
                    [ "report_type" => 'required' ], 
                    [ 'required' => "Cîmpul :attribute este obligatoriu." ],
                    [ 'report_type' => '"Gen expertiză"' ] );
                break;

            case 'Subdiviziuni':
                    $validator = Validator::make($request->all(), 
                    [ "subdivision" => 'required'], 
                    [ 'required' => "Cîmpul :attribute este obligatoriu." ],
                    [ "subdivision" => '"Denumire subdiviziune"'] );
                break;

                case 'Unitati':
                    $validator = Validator::make($request->all(), 
                    [
                        "subdivision_select" => ['required', function($attribute, $value, $fail) use ($request){ 
                            if($value == 0) { $fail('Cîmpul "Subdiviziune" este obligatoriu.'); } 
                        }]
                    ]
                    );
                break;

        }

        return $validator;
    }




}