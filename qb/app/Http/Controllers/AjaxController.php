<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Chapter;
use Datatables;

class AjaxController extends Controller
{
    //
    function getChapters()
    {
        $chapters = Chapter::select();
        return Datatables::of($chapters)->make(true);
    }

    
}
