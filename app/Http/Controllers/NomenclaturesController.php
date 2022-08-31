<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ActionTypes;
use App\Models\Department;
use App\Models\ExaminationTypes;
use App\Models\ExpertiseTypes;
use App\Models\ObjectTypes;
use App\Models\ReportTypes;
use App\Models\Subdivision;


class NomenclaturesController extends Controller
{
    public function show() {
        $table_name = $_POST['table_name'];

        if($table_name != 'subdivisions'){
            $data = DB::table($table_name)->get();
        } else {
            $data = DB::table('departments')
                        ->join('subdivisions', 'subdivision_id', '=', 'subdivisions_id')
                        ->select('*')
                        ->get();
        }
            


        return $data;

    }
}
