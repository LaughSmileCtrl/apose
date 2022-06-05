<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'study_id',
        'name',
        'description',
        'deadline',
    ];

    protected $attributes = [
        'description' => '',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function study()
    {
        return $this->belongsTo(Study::class);
    }

    public function submitedStudents()
    {
        return $this->belongsToMany(User::class, 'student_tasks')
            ->wherePivotIn('status', [-1, 1])
            ->withPivot('status', 'file_path')
            ->withTimestamps();
    }
}
