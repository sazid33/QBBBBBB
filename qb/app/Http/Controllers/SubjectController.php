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
/*
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
  */
        $subjects = DB::table('subjects')
                    ->join('companies', 'subjects.company_id','=','companies.id')
                    ->select('companies.name as company', 'subjects.name as name')
                    ->orderBy('company')
                    ->get();

        return view('superadmin/subjects/index', compact('subjects'));
  
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

        $subject = Subject::create([
            'name' => $request->input('subject_name'),
            'company_id' => $company[0]->id,
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

    public function getSubjectAccordingToProgram(Request $request)
    {
        $company_id = $request->get('company_id');
        $program_id = $request->get('program_id');

        $company_program = DB::select('SELECT id FROM company_programs WHERE company_id = :id1 AND program_id = :id2 ', ['id1' => $company_id, 'id2' => $program_id] );
                            

        $subjects = DB::select('SELECT subjects.id as subject_id, subjects.name as subject_name 
                                    FROM subjects WHERE  id IN (SELECT subject_id 
                                    FROM company_program_subjects WHERE company_program_id = :id)', ['id' => $company_program]);

        $output = array(
            'subjects' => $subjects
        );

        return response()->json($output);
    }
}
