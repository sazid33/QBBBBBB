<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Company;
use App\Role;


class SearchController extends Controller
{
    //
    public function searchUsers(Request $request){
        $user_id = $request->get('user_id');
        $company_id = $request->get('company_id');
        $role_id = $request->get('role_id');

        console.log($user_id);

        if($user_id != 0 && $company_id != 0 && $role_id != 0)
        {
            $users = DB::table('company_users')
                ->join('users','users.id', '=', $user_id)
                ->join('companies','companies.id', '=', $company_id)
                ->join('roles', 'roles.id', '=', $role_id)
                ->select('companies.*', 'users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();

            return view('superadmin/users/index', compact('users'));
        }
    }
}
