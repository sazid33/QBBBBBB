<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Page;
use App\UserPage;
use App\CompanyUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = DB::table('company_users')
                ->join('users','users.id', '=', 'company_users.user_id')
                ->join('companies','companies.id', '=', 'company_users.company_id')
                ->join('roles', 'roles.id', '=', 'company_users.role_id')
                ->select('users.id as id', 'users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
                ->get();

        
        return view('superadmin/users/index', compact('users'));
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
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user = DB::table('users')->orderBy('created_at', 'desc')->first();

        $company_user = new CompanyUser();
        $company_user->company_id = $request->input('company');
        $company_user->user_id = $user->id;
        $company_user->role_id = $request->input('role_user_create');
        $company_user->save();

        $pages = Page::all();
        
        foreach($pages as $page)
        {
            $user_page = new UserPage();
            $user_page->user_id = $user->id;
            $user_page->page_id = $page->id;
            $user_page->allowed_view = 0;
            $user_page->allowed_add = 0;
            $user_page->allowed_update = 0;
            $user_page->allowed_delete = 0;
            $user_page->save();
        }


        if($user && $company_user && $user_page){
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
