<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fika extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'title', 'slug', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected array $hidden = [
        'password'
    ];

    public function times()
    {
        return $this->hasMany(Time::class);
    }
}
