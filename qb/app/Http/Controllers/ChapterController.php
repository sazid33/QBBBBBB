<?php

namespace App\Http\Controllers;

use DB;
use App\Subject;
use App\Chapter;
use Datatables;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $chapters = DB::table('chapters')
                    ->join('subjects', 'chapters.subject_id','=','subjects.id')
                    ->select('subjects.name as subject', 'chapters.name as name', 'chapters.id as id')
                    ->orderBy('name')
                    ->orderBy('subject')
                    ->get();

        return view('superadmin/chapters/index', compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('superadmin/chapters/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $chapters = $request->get('chapters');
        $subject = $request->get('subject_id');
        dd($chapters);
        
        foreach($chapters as $chapter)
        {
            /*
            $create_chapter = Chapter::create([
                'name' => $chapter,
                'subject_id' => $subject,
            ]);
            
            $create_chapter = new Chapter();
            $create_chapter->name = $chapter;
            $create_chapter->subject_id = $subject;
            $create_chapter->save();
        }
        */

        $chapter = new Chapter();
        $chapter->name = $request->input('chapter_name');
        $chapter->subject_id = $request->input('subject');
        $chapter->save();
        
        
        if($chapter)
        {
            return redirect()->route('chapters.index');
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $chapter = Chapter::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = $request->get('chapter_id_update');
        $chapter->id = Chapter::where('id',$id);
        $chapter->name = $request->get('chapter_name_update');
        $chapter->update();

        if($chapter)
        {
            return redirect()->route('chapters.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        //
    }

    function fetchChapter(Request $request)
    {
        $id = $request->input("id");
        $chapter = Chapter::find($id);

        $output = array(
            'chapter_id' => $chapter->id,
            'chapter_name' => $chapter->name,
            'subject_id' => $chapter->subject_id,
        );

        return json_encode($output);
    }

    public function getChapterAccordingToSubject(Request $request)
    {
        $subject_id = $request->get('subject_id');

        $chapters = DB::table('chapters')
                    ->where('subject_id','=', $subject_id)
                    ->select('id as chapter_id','name as chapter_name')
                    ->get();

        $output = array(
            'chapters' => $chapters
        );

        return response()->json($output);
    }


}
