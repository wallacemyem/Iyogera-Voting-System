<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Election extends Model
{
    protected $table = 'election';
    protected $fillable = ['status', 'start', 'end', 'name'];
    public $timestamps = false;

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'question_test');
    }

    public function electionStart()
    {
        return Carbon::createFromFormat('m/d/Y', $this->start);
    }

    public function electionEnd()
    {
        return Carbon::createFromFormat('m/d/Y', $this->end);
    }
}
