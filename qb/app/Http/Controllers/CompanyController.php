<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Company;
use App\User;
use App\Page;
use App\UserPage;
use App\CompanyUser;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getCompanyAccordingToPresentUser()
    {
        
        $util = new UtilityController();
        
        $is_superAdmin = $util->checkSuperAdmin();

        if($is_superAdmin == 1)
        {
            $present_user_company = DB::table('companies')
                                ->select('id as company_id', 'name as company_name')
                                ->get();

            $output = array(
                'company' => $present_user_company,
            );

            return response()->json($output);
        }

        else
        {
            $present_user_company_id = DB::table('company_users')
                            ->where('user_id','=', Auth::id())
                            ->select('company_id as company_id')
                            ->get();

            $present_user_company = DB::table('companies')
                                ->where('id', '=', $present_user_company_id[0]->company_id)
                                ->select('id as company_id', 'name as company_name')
                                ->get();

            $output = array(
                'company' => $present_user_company,
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
        $companies = Company::all();
        return view('superadmin/companies/index', compact('companies'));
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
            $company = new Company();
            $company->name = $request->input('company_name');
            $company->status = $request->input('status');
            $company->save();

            $company = DB::table('companies')->orderBy('created_at', 'desc')->first();

            $user = new User();
            $user->name = $request->input('user_name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            $user = DB::table('users')->orderBy('created_at', 'desc')->first();

            $company_user = new CompanyUser();
            $company_user->company_id = $company->id;
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

            if($company && $user && $company_user){
                return redirect()->route('companies.index');
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    
}
