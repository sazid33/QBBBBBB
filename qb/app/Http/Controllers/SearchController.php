<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Company;
use App\Role;
use DB;


class SearchController extends Controller
{
    //
    public function searchUsers(Request $request){
        $user_id = $request->get('user_id');
        $company_id = $request->get('company_id');
        $role_id = $request->get('role_id');
       
        if($user_id != 0 && $company_id != 0 && $role_id != 0)
        {
            $users = DB::table('company_users')
                ->where([['user_id', '=', $user_id],
                        ['company_id', '=', $company_id],
                        ['role_id','=', $role_id]])
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();
        }

        else if($user_id != 0 && $company_id != 0)
        {
            $users = DB::table('company_users')
                ->where([['user_id', '=', $user_id],
                        ['company_id', '=', $company_id]])
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();
        }

        else if($user_id != 0 && $role_id != 0)
        {
            $users = DB::table('company_users')
                ->where([['user_id', '=', $user_id],
                        ['role_id','=', $role_id]])
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();
        }

        else if($company_id !=0 && $role_id != 0)
        {
            $users = DB::table('company_users')
                ->where([['company_id', '=', $company_id],
                        ['role_id','=', $role_id]])
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();
        }

        else if($user_id != 0)
        {
            $users = DB::table('company_users')
                ->where('user_id', '=', $user_id)
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();
        }

        else if($company_id != 0)
        {
            $users = DB::table('company_users')
                ->where('company_id', '=', $company_id)
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();
        }

        else if($role_id != 0)
        {
            $users = DB::table('company_users')
                ->where('role_id', '=', $role_id)
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();

        }

        else if($user_id == 0 && $company_id == 0 && $role_id == 0)
        {
            $users = DB::table('company_users')
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();
        }

        $output = array(
            'users' => $users
        );
        
        return response()->json($output);
       
    }
}
