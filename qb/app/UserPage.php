<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPage extends Model
{
    //
    protected $table = 'user_pages';

    protected $fillable = ['user_id', 'page_id', 'allowed_view', 'allowed_add', 'allowed_update', 'allowed_delete'];
}
