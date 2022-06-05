<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Study extends Model
{
    use SoftDeletes, CascadeSoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'conversation_url',
        'icon_path',
    ];

    protected $cascadeDeletes = [
        'modules',
        'tasks',
    ];

    protected $attributes = [
        'conversation_url' => '',
        'icon_path' => 'studies/icons/default.png',
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

    public function teacher()
    {
        return $this->belongsToMany(User::class, 'teacher_studies');
    }
}
