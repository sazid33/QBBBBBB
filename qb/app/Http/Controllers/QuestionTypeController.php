<?php

namespace App\Http\Controllers;

use App\QuestionType;
use Illuminate\Http\Request;

class QuestionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = QuestionType::all();
        return view('superadmin/question_types/index', compact('types'));
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
            $question_type = new QuestionType();
            $question_type->name = $request->input('name');
            $question_type->header_text = $request->input('header_text');
            $question_type->save();

            if($question_type){
                return redirect()->route('question_types.index');
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
     * @param  \App\QuestionType  $questionType
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionType $questionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionType  $questionType
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionType $questionType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionType  $questionType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionType $questionType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionType  $questionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionType $questionType)
    {
        //
    }
}
