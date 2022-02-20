<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'last_name',
        'occupation',
        'mail',
        'age',
        'sex'
    ];
    public function events()
    {
        return $this->belongsToMany(Event::class)->withTimestamps();
    }
}
