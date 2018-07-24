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
        
        $is_active = DB::table('user_page')
                    ->where('user_id', $users->user_id)
                    ->where('page_id', $pages->id)
                    ->select('is_active')
                    ->get();

        return view('superadmin/users_page_list/show', compact('users', 'pages', 'is_active'));
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
