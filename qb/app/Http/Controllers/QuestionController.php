<?php

namespace App\Http\Controllers;

use DB;
use App\Question;
use App\Topic;
use App\TopicQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('superadmin/questions/create'); 
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
        $topic_id = $request->get('topic_id');
        $chapter_id = $request->get('chapter_id');
        $question_type_id = $request->get('question_type_id');
        $question = $request->get('question');
        $options = $request->get('options');
        $answer = $request->get('answer');
        $priority = $request->get('priority');
        $difficulty = $request->get('difficulty');

        $output = array(
            'question' => $question,
            'options' => $options,
            'answer' => $answer
        );

        $output = serialize($output);


        $question = new Question();

        $question->question_type_id = $question_type_id;
        $question->text = $output;
        $question->priority = $priority;
        $question->difficulty = $difficulty;

        $question->save();

        $question = DB::table('questions')->orderBy('created_at', 'desc')->first();

        $topic_question = new TopicQuestion();

        $topic_question->topic_id = $topic_id;
        $topic_question->question_id = $question->id;

        $topic_question->save();

        $chapter_question = new ChapterQuestion();

        $chapter_question->chapter_id = $chapter_id;
        $chapter_question->question_id = $question->id;

        $chapter_question->save();


        return response()->json("success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
