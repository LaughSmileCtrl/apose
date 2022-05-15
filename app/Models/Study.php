<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
