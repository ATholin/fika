<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fika extends Model
{
    protected $fillable = ['title', 'slug'];

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
