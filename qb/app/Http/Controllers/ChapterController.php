<?php

namespace App\Http\Controllers;

use DB;
use App\Subject;
use App\Chapter;
use Datatables;
use Illuminate\Http\Request;

class ChapterController extends Controller
{   
    public function getId()
    {

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $util = new UtilityController();

        $page_id = $util->getPageId("Chapter");
        $is_allowed = $util->getUserPageAuthentication($page_id[0]->id, "view");

        if($is_allowed[0]->is_allowed==1)
        {
            $chapters = DB::table('chapters')
                    ->join('subjects', 'chapters.subject_id','=','subjects.id')
                    ->join('companies', 'companies.id', '=', 'subjects.company_id')
                    ->select('companies.name as company', 'subjects.name as subject', 'chapters.name as name', 'chapters.id as id')
                    ->orderBy('company')
                    ->orderBy('name')
                    ->orderBy('subject')
                    ->get();

            return view('superadmin/chapters/index', compact('chapters'));
        }

        else
        {
            return view('/unauthorizedAlert');
        }        
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
        $util = new UtilityController();

        $page_id = $util->getPageId("Chapter");
        $is_allowed = $util->getUserPageAuthentication($page_id[0]->id, "add");

        if($is_allowed[0]->is_allowed==1)
        {
            $chapter = new Chapter();
            $chapter->name = $request->input('chapter_name');
            $chapter->subject_id = $request->input('subject_id');
            $chapter->save();
            
            
            if($chapter)
            {
                return redirect()->route('chapters.index');
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

        $util = new UtilityController();

        $page_id = $util->getPageId("Chapter Update");
        $is_active = $util->getUserPageAuthentication($page_id[0]->id);

        if($is_active[0]->is_active==1)
        {
            $chapter = Chapter::find($id);
        }

        else
        {
            return view('/unauthorizedAlert');
        }
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
        $util = new UtilityController();

        $page_id = $util->getPageId("Chapter");
        $is_allowed = $util->getUserPageAuthentication($page_id[0]->id, "update");

        if($is_allowed[0]->is_allowed==1)
        {
            $id = $request->get('chapter_id_update');
            $updated_chapter_name = $request->get('chapter_name_update');

            $chapter = DB::table('chapters')
                    ->where('id', '=', $id)
                    ->update(['name' => $updated_chapter_name]);
            
            return response()->json($chapter);
        }
        
        else
        {
            return view('/unauthorizedAlert');
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
