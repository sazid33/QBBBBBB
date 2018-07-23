<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $table = 'programs';

    protected $fillable = ['name', 'degree_id'];

    public function degrees()
    {
        return $this->belongsTo('App\degrees', 'foreign_key');
    }
}
