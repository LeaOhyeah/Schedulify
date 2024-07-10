<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    // Relation on model Meeting
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

}
