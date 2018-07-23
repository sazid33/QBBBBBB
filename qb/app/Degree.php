<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    //
    protected $table = 'degrees';

    protected $fillable = ['name'];

    public function programs()
    {
        return $this->hasMany('App\programs');
    }
}
