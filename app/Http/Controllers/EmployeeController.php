<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DataValidationController;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Expert;
use Hamcrest\Core\IsNull;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class EmployeeController extends Controller
{

    protected $UpdateStatus = 'free';
    protected $DeleteStatus = 'free';


    public function register(Request $request) {
        $DataValidation = new DataValidationController();

        $validator = $DataValidation->employeeValidation($request);
        if ($validator->fails()) {
            return redirect('employee_manager')
                        ->withErrors($validator)
                        ->withInput();
        }
        $validatedData = $validator->validated();

        try {
            DB::beginTransaction();
                $User = User::create([
                    'name' => $validatedData['user_name'],
                    'username' => $validatedData['username'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                    'accesstype' => $validatedData['user-accesstype'] == "1" ? 'Administrator' : 
                                    ($validatedData['user-accesstype'] == "2" ? 'Worker' : 
                                        ($validatedData['user-accesstype'] == "3" ? 'User' : null)),
                ]);
    
                $Expert = Expert::create([
                    'expert_name' => $validatedData['expert_name'],
                    'expert_surname' => $validatedData['expert_surname'],
                    'function' => $validatedData['function'],
                    'active' => isset($_POST['active']) ? 1 : 0,
                    'novice' => isset($_POST['novice']) ? 1 : 0,
                    'user_id' => $User['id']
                ]);
            DB::commit();
            return view('/pages.EmployeeManagement.employeeRegister', ['notificationCheck' => 'EmployeeRegisterSuccess']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return view('/pages.EmployeeManagement.employeeRegister', ['notificationCheck' => 'EmployeeRegisterError']);

            // throw $ex; de prelucrat erorile
        }

    }



    public function show(Request $request) {

        $data = $this->getEmployee('1');
        $routeAction = substr(Route::currentRouteAction(), strpos(Route::currentRouteAction(), '@')+1);

        switch ($routeAction) {
            case 'update':
                if($request->ajax() ) {
                    return view('pages.EmployeeManagement.employeePaginatedTable', ['data' => $data, 'DeleteStatus' => 'free', 
                                'UpdateStatus' => $this->UpdateStatus, 'routeAction'=>$routeAction ])->render();
                }
                return view('pages.EmployeeManagement.employeeView', ['data' => $data, 'DeleteStatus' => 'free', 
                            'UpdateStatus' => $this->UpdateStatus, 'routeAction'=>$routeAction]);

            default:
                if($request->ajax() ) {
                    return view('pages.showTablePaginated', ['data' => $data, 'DeleteStatus' => 'free', 
                    'UpdateStatus' => 'free', 'routeAction'=>$routeAction])->render();
                }

                return view('pages.EmployeeManagement.employeeView', ['data' => $data, 'DeleteStatus' => 'free', 
                            'UpdateStatus' => 'free', 'routeAction'=>$routeAction]);
        }
    }



    public function update(Request $request) {

        if(isset($request['expert_id'])) {
            $updatedExpert = DB::table('experts')
                ->where('experts_id', $request['expert_id'])
                ->update([
                        'expert_name' => $request["expert_name"],
                        'expert_surname' => $request["expert_surname"],
                        'function' => $request["function"],
                        'novice' => $request["novice"],
                        'active' => $request["active"],
                ]);

            
            if($updatedExpert == 1) {
                $this->UpdateStatus = "EmployeeUpdateSuccess";
            } else{
                $this->UpdateStatus = "EmployeeUpdateError";
            }
        
        } else {
            $updatedUser = DB::table('users')
                ->where('id', $request['user_id'])
                ->update([
                        'name' => $request["name"],
                        'username' => $request["username"],
                        'email' => $request["email"],
                        'accesstype' => $request["accesstype"],
                ]);

            if($updatedUser == 1) {
                $this->UpdateStatus = "EmployeeUpdateSuccess";
            } else{
                $this->UpdateStatus = "EmployeeUpdateError";
            }
        }

        return $this->show($request);
    }

    

    public function getDetailedEmployeeData() {
        $item_id = $_POST['item_id'];

        switch ($_POST['section']) {
            case 'expert':
                $data = $this->getEmployee("experts_id = $item_id");
                break;
            
            case 'user':
                $data = $this->getEmployee("id = $item_id");
                break;
        }

        return $data;
    }



    private function getEmployee($where) {
        $data = DB::table('experts')
            ->join('users', 'id', '=', 'user_id')
            ->select(['*', 'users.created_at as user_created_at', 'experts.created_at as expert_created_at'])
            ->whereRaw($where)
            ->orderBy('experts_id', 'asc')
            ->paginate(10);

        foreach($data as $item) {
            $item->user_created_at = date('Y-m-d', strtotime($item->user_created_at));
            $item->expert_created_at = date('Y-m-d', strtotime($item->expert_created_at));
            $item->expert_name = ucwords(strtolower($item->expert_name));
            $item->expert_surname = ucwords(strtolower($item->expert_surname));
            $item->function = ucwords(strtolower($item->function));
            $item->active == 0 ? $item->active = 'Inactiv' : $item->active = 'Activ';
            $item->novice == 0 ? $item->novice = 'Nu' : $item->novice = 'Da';
            $item->name = ucwords(strtolower($item->name));
        }

        return $data;

    }

}
