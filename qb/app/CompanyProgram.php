<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProgram extends Model
{
    //
    protected $table = 'company_programs';

    protected $fillable = ['company_id', 'program_id', 'allowed_subject','status'];
}
