<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected array $fillable = ['start', 'end'];

    public function fika()
    {
        return $this->belongsTo(Fika::class);
    }
}
