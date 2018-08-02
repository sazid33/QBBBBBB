<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    //
    protected $table = 'question_types';

    protected $fillable = ['name', 'header_text'];
}
