<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'theme',
        'start_date',
        'hour',
        'price',
        'place',
        'speaker'
    ];
    public function participants()
    {
        return $this->belongsToMany(Participant::class)->withTimestamps();
    }
}
