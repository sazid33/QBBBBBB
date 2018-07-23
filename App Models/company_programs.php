<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company_programs extends Model
{
    //
    protected $table = 'company_programs';

    protected $fillable = ['company_id', 'program_id', 'status'];
}
