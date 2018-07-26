<?php

namespace App\Http\Controllers;

use DB;
use App\Subject;
use App\Company;
use App\Programs;
use App\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user = Auth::user();

        $isSuperAdmin = DB::table('company_users')
                        ->where('user_id','=',$user->id)
                        ->select('role_id as role')
                        ->get();

        if($isSuperAdmin[0]->role == 1)
        {
            $subjects = Subject::all();
            return view('superadmin/subjects/index', compact('subjects'));
        }

        else
        {
            $subjects = Subject::all();
            return view('user/subjects/index', compact('subjects'));
        }
        
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
        $company = DB::table('companies')
                ->where('id','=', $request->input('company'))
                ->get();
        
        $program = DB::table('programs')
                ->where('id', '=', $request->input('program'))
                ->get();

        $company_program = DB::table('company_programs')
                        ->where('company_id','=',$company[0]->id)
                        ->where('program_id', '=', $program[0]->id)
                        ->get();

        $subject = Subject::create([
            'name' => $request->input('name'),
            'company_program_id' => $company_program[0]->id,
        ]);

        if($subject){
            return redirect()->route('subjects.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
