<?php

namespace App\Http\Controllers;

use App\CompanyProgramSubject;
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
