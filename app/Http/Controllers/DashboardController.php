<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DossierController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    protected $UpdateStatus = 'free';


    public function getLoggedUserDossiers(Request $req){
        $dosControl = new DossierController();
        $loggedUser = Auth::user();
        $userExpert = DB::table('experts')->where('user_id', '=', $loggedUser->id)->get();

        foreach($userExpert as $item){
            $userExpert = $item;
        }

        $dossiers = $dosControl->getDossierPartialData('expert_id = ' . $userExpert->experts_id, 10);
        $routeAction = substr(Route::currentRouteAction(), strpos(Route::currentRouteAction(), '@')+1);


        switch ($routeAction) {
            case 'update':
                if($req->ajax() ) {
                    return view('pages.DossierManagement.dossierPaginatedTable', ['dossiers' => $dossiers, 'DeleteStatus' => 'free', 
                    'UpdateStatus' => $this->UpdateStatus, 'routeAction'=>$routeAction, 
                    'user' => $userExpert->expert_name . ' ' . $userExpert->expert_surname])->render();
                }

                return view('pages.Dashboard.dashboard', ['dossiers' => $dossiers, 'DeleteStatus' => 'free', 
                            'UpdateStatus' => $this->UpdateStatus, 'routeAction'=>$routeAction, 
                            'user' => $userExpert->expert_name . ' ' . $userExpert->expert_surname]);

            default:
                if($req->ajax() ) {
                    return view('pages.DossierManagement.dossierPaginatedTable', ['dossiers' => $dossiers, 'DeleteStatus' => 'free', 
                                'UpdateStatus' => 'free', 'routeAction'=>$routeAction, 
                                'user' => $userExpert->expert_name . ' ' . $userExpert->expert_surname])->render();
                }

                return view('pages.Dashboard.dashboard', ['dossiers' => $dossiers, 'DeleteStatus' => 'free', 
                        'UpdateStatus' => 'free', 'routeAction'=>$routeAction, 
                        'user' => $userExpert->expert_name . ' ' . $userExpert->expert_surname]);
        }
    }

}
