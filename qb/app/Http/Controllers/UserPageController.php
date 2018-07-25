<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Page;
use App\Company;
use App\UserPage;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Company::all();

        return view('superadmin/users_page_list/index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserPage  $userPage
     * @return \Illuminate\Http\Response
     */
    public function show($company_id)
    {
        $users = DB::select("select users.id as user_id, users.name as user_name from users WHERE users.id IN 
                (select company_users.user_id from company_users WHERE company_users.company_id=$company_id)");
        
        $pages = Page::all();

        $user_id_string = "";
        foreach($users as $user)
        {
            $user_id_string=$user_id_string.$user->user_id.",";
        }
        $user_id_string = substr($user_id_string, 0, strlen($user_id_string)-1);

        $page_id_string = "";

        foreach($pages as $page)
        {
            $page_id_string = $page_id_string.$page->id.",";
        }

        $page_id_string = substr($page_id_string, 0, strlen($page_id_string)-1);
        
        $is_actives = DB::select("select * from user_pages where page_id IN (".$page_id_string.") and user_id IN (".$user_id_string.") order by page_id, user_id;");

        $counter = 0;
        
        return view('superadmin/users_page_list/show', compact('users', 'pages', 'is_actives', 'counter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserPage  $userPage
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPage $userPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserPage  $userPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPage $userPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserPage  $userPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPage $userPage)
    {
        //
    }

    public function getCompanyUsers($company_id)
	{
	}
}
