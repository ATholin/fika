<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fika extends Model
{
    protected array $fillable = ['title', 'slug', 'password'];

    protected array $hidden = ['password'];

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
