<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companies_users extends Model
{
    //
    protected $table = 'companies_users';

    protected $fillable = ['company_id','user_id','role_id'];
}
