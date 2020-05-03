<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fika extends Model
{
    protected $fillable = ['title', 'slug', 'password'];

    protected $hidden = ['password'];

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
