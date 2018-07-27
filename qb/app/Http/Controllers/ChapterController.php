<?php

namespace App\Http\Controllers;

use DB;
use App\Subject;
use App\Chapter;
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
                    ->select('subjects.name as subject', 'chapters.name as name')
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
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        //
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
}
