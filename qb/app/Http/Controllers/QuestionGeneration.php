<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionGeneration extends Controller
{
    //
    public function choose()
    {
        return view('questiongeneration/choose');
    }
}
