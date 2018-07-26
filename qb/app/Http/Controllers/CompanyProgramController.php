<?php

namespace App\Http\Controllers;

use DB;
use App\Company;
use App\Program;
use App\CompanyProgram;
use Illuminate\Http\Request;

class CompanyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $company_programs = DB::table('company_programs')
                            ->join('companies', 'company_programs.company_id', '=' , 'companies.id')
                            ->join('programs', 'company_programs.program_id', '=', 'programs.id')
                            ->select('company_programs.status', 'companies.name as company', 'programs.name as program')
                            ->orderBy('company')
                            ->get();
                            
        return view('superadmin/company_programs/index', compact('company_programs'));
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
        $company_program = new CompanyProgram();
        $company_program->company_id = $request->input('company_id');
        $company_program->program_id = $request->input('program_id');
        $company_program->allowed_subject = $request->input('allowed_subject');
        $company_program->status = $request->input('status');
        $company_program->save();

        if($company_program)
        {
            return redirect()->route('company_programs.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyProgram  $companyProgram
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyProgram $companyProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyProgram  $companyProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyProgram $companyProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyProgram  $companyProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyProgram $companyProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyProgram  $companyProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyProgram $companyProgram)
    {
        //
    }
}
