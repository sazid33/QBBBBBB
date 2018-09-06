<?php

namespace App\Http\Controllers;

use DB;
use App\QuestionType;
use Illuminate\Http\Request;

class QuestionGenerationController extends Controller
{
    //
    public function index()
    {
        $question_types = QuestionType::all();

        return view('questiongeneration/choose', compact('question_types'));
    }
}
