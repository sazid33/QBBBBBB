<?php

namespace App\Http\Controllers;

use DB;
use App\Subject;
use App\Chapter;
use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topics = DB::table('topics')
                    ->join('chapters', 'topics.chapter_id','=','chapters.id')
                    ->join('subjects', 'chapters.subject_id','=','subjects.id')
                    ->select('topics.id as id', 'subjects.name as subject', 'chapters.name as chapter', 'topics.name as name')
                    ->orderBy('subject')
                    ->orderBy('chapter')
                    ->get();

        return view('superadmin/topics/index', compact('topics'));
    }

    public function getChapterAccordingToSubject(Request $request)
    {
        $subject_id = $request->get('subject_id');

        $chapters = DB::table('chapters')
                    ->where('subject_id', $subject_id)
                    ->select('chapters.id as chapter_id', 'chapters.name as chapter_name')
                    ->get();

        $output = array(
            'chapters' => $chapters
        );

        return response()->json($output);
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
        $topics = new Topic();
        $topics->name = $request->input('name');
        $topics->chapter_id = $request->input('chapter');
        $topics->save();

        if($topics)
        {
            return redirect()->route('topics.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }

    public function getTopicAccordingToChapter(Request $request)
    {
        $chapter_id = $request->get('chapter_id');

        $topics = DB::table('topics')
                ->where('chapter_id','=',$chapter_id)
                ->select('id as topic_id','name as topic_name')
                ->get();

        $output = array(
            'topics' => $topics
        );

        return response()->json($output);
    }
}
