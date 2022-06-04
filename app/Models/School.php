<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class School extends Model
{
    use SoftDeletes, CascadeSoftDeletes , HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $cascadeDeletes = [
        'classrooms',
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
