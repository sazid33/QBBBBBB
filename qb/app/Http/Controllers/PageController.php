<?php

namespace App\Http\Controllers;

use DB;
use App\Page;
use App\User;
use App\UserPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = DB::table('pages')
                ->select('pages.id as id', 'pages.name as name')
                ->orderBy('name')
                ->get();

        return view('superadmin/pages/index', compact('pages'));
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
            $page = new Page();
            $page->name = $request->input('name');
            $page->save();

            $page = DB::table('pages')->orderBy('created_at', 'desc')->first();

            $users = User::all();

            foreach($users as $user)
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
            

            if($page)
            {
                return redirect()->route('pages.index');
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
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
