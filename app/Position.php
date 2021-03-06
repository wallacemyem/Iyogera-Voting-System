<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';
    protected $fillable = ['name', 'election_id'];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }
}
