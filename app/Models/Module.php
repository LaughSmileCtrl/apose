<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'file_path',
    ];

    public function study()
    {
        return $this->belongsTo(Study::class);
    }
}
