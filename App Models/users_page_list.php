<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users_page_list extends Model
{
    //
    protected $table = 'users_page_list';

    protected $fillable = ['user_id', 'page_list_id', 'is_active'];
}
