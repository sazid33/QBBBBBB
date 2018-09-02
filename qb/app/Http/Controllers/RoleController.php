<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display Role List According To Present User's Role
     */

    public function getRoleAccordingToPresentUsersRole()
    {
        $present_user_id = Auth::id();

        $present_user_role_id = DB::table('company_users')
                            ->where('user_id', '=', $present_user_id)
                            ->select('role_id as role_id')
                            ->get(); 
        
        $present_user_role_priority = DB::table('roles')
                                    ->where('id','=', $present_user_role_id[0]->role_id)
                                    ->select('priority as priority')
                                    ->get();

        $roles = DB::table('roles')
                ->where('priority', '>=', $present_user_role_priority[0]->priority)
                ->select('id as role_id', 'name as role_name')
                ->get();

        $output = array(
            'roles' => $roles
        );

        return response()->json($output);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::orderBy('priority')->get();
        return view('superadmin/roles/index', compact('roles'));
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

        $utils = new UtilityController();

        $present_user_role = $utils->getUserRole();
        
        if($present_user_role[0]->role_name=="Super Admin")
        {
            $role = Role::create([
                'name' => $request->input('name'),
                'description' =>$request->input('description'),
                'priority' => $request->input('priority'),
            ]);
    
            if($role){
                return redirect()->route('roles.index');
            }
        }

        else
        {
            return view('/unauthorizedAlert');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
