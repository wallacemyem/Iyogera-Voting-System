<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Election extends Model
{
    protected $table = 'election';
    protected $fillable = ['status', 'start', 'end', 'name'];
    public $timestamps = false;

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'question_test');
    }


}
