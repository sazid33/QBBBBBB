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
    public function getSubjectAccordingToPresentUser(Request $request)
    {
        $company_id = $request->id;
        $util = new UtilityController();

        $is_superAdmin = $util->checkSuperAdmin();

        if($is_superAdmin == 0)
        {
            $subjects = DB::table('subjects')
                    ->join('companies', 'subjects.company_id','=','companies.id')
                    ->select('subjects.id as id','companies.name as company', 'subjects.name as name')
                    ->orderBy('company')
                    ->get();

            $output = array(
                'subjects' => $subjects
            );

            return response()->json($output);
        }

        else
        {
            $subjects = DB::table('subjects')
                    ->join('companies', 'subjects.company_id','=','companies.id')
                    ->select('subjects.id as id','companies.name as company', 'subjects.name as name')
                    ->orderBy('company')
                    ->get();

            $output = array(
                'subjects' => $subjects
            );

            return response()->json($output);
        }
    }

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
                    ->select('subjects.id as id','companies.name as company', 'subjects.name as name')
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


        $company_program = DB::table('company_programs')->where([['company_id','=',$company_id],
                            ['program_id','=', $program_id]])
                            ->select('id as company_program_id')
                            ->get();

        $subjects = DB::select('SELECT subjects.id as subject_id, subjects.name as subject_name 
                                    FROM subjects WHERE  id IN (SELECT subject_id 
                                    FROM company_program_subjects WHERE company_program_id = :id)', 
                                    ['id' => $company_program[0]->company_program_id]);

        $output = array(
            'subjects' => $subjects
        );

        return response()->json($output);
    }

    public function getSubjectAccordingToCompany(Request $request)
    {  
        $company_id = $request->get('company_id');

        $subjects = DB::table('subjects')->where('company_id','=',$company_id)
                            ->select('id as subject_id', 'name as subject_name')
                            ->get();

        $output = array(
            'subjects' => $subjects
        );

        return response()->json($output);

    }
}
