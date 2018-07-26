<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProgramSubject extends Model
{
    //
    protected $table = 'company_program_subjects';

    protected $fillable = ['company_program_id', 'subject_id'];
}
