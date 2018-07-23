<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subjects extends Model
{
    //
    protected $table = 'subjects';

    protected $fillable = ['name', 'company_program_id'];
}
