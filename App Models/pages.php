<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pages extends Model
{
    //
    protected $table = 'page_lists';

    protected $fillable = ['name'];
}
