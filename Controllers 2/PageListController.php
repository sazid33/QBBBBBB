<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pages;
use App\User;
use DB;
use App\users_page_list;

class PageListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = pages::all();
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
        $page = new pages();
        $page->name = $request->input('name');
        $page->save();

        $page = DB::table('page_lists')->orderBy('created_at', 'desc')->first();

        $users = User::all();

        foreach($users as $user)
        {
            $user_page = new users_page_list();
            $user_page->user_id = $user->id;
            $user_page->page_list_id = $page->id;
            $user_page->is_active = 0;
            $user_page->save();
        }
        

        if($page){
            return redirect()->route('pages.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
