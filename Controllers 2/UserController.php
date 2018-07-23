<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use DB;
use App\companies_users;
use App\users_page_list;
use App\pages;

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
        $users = DB::table('companies_users')
                ->join('users','users.id', '=', 'companies_users.user_id')
                ->join('companies','companies.id', '=', 'companies_users.company_id')
                ->join('roles', 'roles.id', '=', 'companies_users.role_id')
                ->select('companies.*', 'users.name as user_name', 'users.email as user_email', 'companies.name as company_name', 'roles.name as role_name')
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
        /*
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if($user){
            return redirect()->route('companies.index');
        }
        */

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user = DB::table('users')->orderBy('created_at', 'desc')->first();

        $company_user = new companies_users();
        $company_user->company_id = $request->input('company');
        $company_user->user_id = $user->id;
        $company_user->role_id = $request->input('role');
        $company_user->save();

        //echo $user;

        $pages = pages::all();
        
        foreach($pages as $page)
        {
            $user_page = new users_page_list();
            $user_page->user_id = $user->id;
            $user_page->page_list_id = $page->id;
            $user_page->is_active = 0;
            $user_page->save();
        }


        if($user && $company_user && $user_page){
            return redirect()->route('users.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
