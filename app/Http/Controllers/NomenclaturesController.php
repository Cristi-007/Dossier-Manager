<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
}
