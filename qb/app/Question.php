<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = 'questions';

    protected $fillable = ['question_type_id', 'text', 'priority', 'difficulty'];
}
