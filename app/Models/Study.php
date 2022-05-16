<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_url'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
