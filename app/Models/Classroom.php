<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Classroom extends Model
{
    use SoftDeletes, CascadeSoftDeletes, HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $cascadeDeletes = [
        'studies',
    ];
    
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'classroom_students');
    }

    public function studies()
    {
        return $this->hasMany(Study::class);
    }
}
