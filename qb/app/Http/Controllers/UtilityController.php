<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class UtilityController extends Controller
{
    //
    public function checkSuperAdmin()
    {
        $present_user_id = Auth::id();

        $present_user_role = DB::table('company_users')
                            ->where('user_id', '=', $present_user_id)
                            ->select('role_id as role_id')
                            ->get();

        $present_user_role_priority = DB::table('roles')
                                    ->where('id', '=', $present_user_role[0]->role_id)
                                    ->select('priority as priority')
                                    ->get();

        $super_admin_priority = DB::table('roles')
                        ->where('name', '=', 'Super Admin')
                        ->select('priority as priority')
                        ->get();

        if($present_user_role_priority[0]->priority == $super_admin_priority[0]->priority)
        {
            return 1;
        }

        else
        {
            return 0;
        }
    }

    public function getUserRole()
    {
        $present_user_id = Auth::id();

        $present_user_role_id = DB::table('company_users')
                            ->where('user_id', '=', $present_user_id)
                            ->select('role_id as role_id')
                            ->get();

        $present_user_role = DB::table('roles')
                            ->where('id', '=', $present_user_role_id[0]->role_id)
                            ->select('name as role_name')
                            ->get();

        return $present_user_role;
    }

    public function getUserCompany()
    {
        $present_user_id = Auth::id();

        $present_user_company = DB::table('company_users')
                            ->where('user_id', '=', $present_user_id)
                            ->select('company_id as company_id')
                            ->get();

        return $present_user_company[0]->company_id;
    }

    public function getPageId($page_name)
    {
        $page_id = DB::table('pages')
                ->where('name', '=', $page_name)
                ->select('id as id')
                ->get();
        
        return $page_id;

    }

    public function getUserPageAuthentication($page_id, $page_tag)
    {
        $user_id = Auth::id();
        $page_tag = $page_tag;

        if($page_tag == "view")
        {
            $is_allowed = DB::table('user_pages')
                    ->where([['user_id','=',$user_id],['page_id','=',$page_id]])
                    ->select('allowed_view as is_allowed')
                    ->get();

            return $is_allowed;
        }

        else if($page_tag == "add")
        {
            $is_allowed = DB::table('user_pages')
                    ->where([['user_id','=',$user_id],['page_id','=',$page_id]])
                    ->select('allowed_add as is_allowed')
                    ->get();

            return $is_allowed;
        }

        else if($page_tag == "update")
        {
            $is_allowed = DB::table('user_pages')
                    ->where([['user_id','=',$user_id],['page_id','=',$page_id]])
                    ->select('allowed_update as is_allowed')
                    ->get();
            
            return $is_allowed;
        }

        else if($page_tag == "delete")
        {
            $is_allowed = DB::table('user_pages')
                    ->where([['user_id','=',$user_id],['page_id','=',$page_id]])
                    ->select('allowed_delete as is_allowed')
                    ->get();
        
            return $is_allowed;    
        }
    }

}
