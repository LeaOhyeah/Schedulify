<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    // Relation on model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation on model Participant
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

}
