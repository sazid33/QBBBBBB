<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //

    protected $table = 'chapters';

    protected $fillable = ['name', 'subject_id'];
}
