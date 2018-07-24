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
         
        /*$users = DB::table('company_users', 'company_id', '=', $company_id)
                        ->select('user_id')
                        ->get();
        
        $user_page = DB::table('user_pages', 'user_id','=', $users)
                    ->join('pages', 'id','=','user_pages.page_id')
                    ->join('users', 'id','=',$users)
                    ->select('pages.name as pages', 'users.name as users', 'is_active')
                    ->get();
        

        $users = DB::table('users')
                ->join('company_users', 'company_id', '=', $company_id)
                ->select('')
                ->get();
*/
        $users = DB::select("select users.id as user_id, users.name as user_name from users WHERE users.id IN 
                    (select company_users.user_id from company_users WHERE company_users.company_id=$company_id)");
        $pages = Page::all();

        

        return view('superadmin/users_page_list/show', compact('users', 'pages'));
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
