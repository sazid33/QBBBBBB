<?php

namespace App\Http\Controllers;

use DB;
use App\CompanyProgramSubject;
use App\Company;
use App\Program;
use App\Subject;
use Illuminate\Http\Request;

class CompanyProgramSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('superadmin/company_program_subjects/index');
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

        $company_id = $request->get('company');
        $program_id = $request->get('program');
        $subject_id = $request->get('subject');

        $company_program = DB::table('company_programs')->where([['company_id','=',$company_id],
                            ['program_id','=', $program_id]])
                            ->select('id as company_program_id')
                            ->get();

        $company_program_subject = new CompanyProgramSubject();
        $company_program_subject->company_program_id = $company_program[0]->company_program_id;
        $company_program_subject->subject_id = $subject_id;
        $company_program_subject->save();

        if($company_program_subject)
        {
            return redirect()->route('superadmin/company_program_subjects/index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyProgramSubject  $companyProgramSubject
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyProgramSubject $companyProgramSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyProgramSubject  $companyProgramSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyProgramSubject $companyProgramSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyProgramSubject  $companyProgramSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyProgramSubject $companyProgramSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyProgramSubject  $companyProgramSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyProgramSubject $companyProgramSubject)
    {
        //
    }
}
