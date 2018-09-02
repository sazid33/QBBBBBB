<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class UtilityController extends Controller
{
    //
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
