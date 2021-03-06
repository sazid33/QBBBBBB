<?php

namespace App\Http\Controllers;

use DB;
use App\Program;
use App\CompanyProgram;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function getProgramAccordingToPresentUserCompany()
    {
        $util = new UtilityController();

        $is_superAdmin = $util->checkSuperAdmin();

        if($is_superAdmin == 0)
        {
            $present_user_company = $util->getUserCompany();

            $company_programs = DB::table('company_programs')
                        ->join('programs', 'company_programs.program_id', '=', 'programs.id')
                        ->where('company_programs.company_id', '=', $present_user_company)
                        ->select('programs.name as program', 'programs.id as program_id')
                        ->get();
            $output = array(
                'company_programs' => $company_programs
            );

            return response()->json($output);
        }

        else
        {
            
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
        $programs = DB::table('programs')
                    ->join('degrees', 'programs.degree_id', '=', 'degrees.id')
                    ->select('programs.*', 'degrees.name as degree')
                    ->orderBy('degree')
                    ->get();
        return view('superadmin/programs/index', ["programs"=>$programs]);
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
            $program = Program::create([
                'name' => $request->input('name'),
                'degree_id' => $request->input('degree'),
            ]);
    
            if($program){
                return redirect()->route('programs.index');
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
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //
    }

    public function getProgramAccordingToCompany(Request $request)
    {
        $company_id = $request->get('company_id');

        $programs = DB::select('SELECT programs.id as program_id, programs.name as program_name FROM programs WHERE id IN 
        (SELECT program_id FROM company_programs WHERE company_id = :id)', ['id' => $company_id]);

        /*$programs = DB::table('programs')
                    ->join('company_programs', 'company_id', '=', $company_id)
                    ->select('programs.id as program_id', 'programs.name as program_name')
                    ->get();
*/
        $output = array(
            'programs' => $programs
        );

        return response()->json($output);
    }
}
