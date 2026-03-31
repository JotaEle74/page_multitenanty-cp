<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'name',
        'slug',
        'presentation',
        'presentation_image',
        'historia',
        'img_cifras',
        'image_url',
        'mission',
        'vision',
        'cifras',
        'plan_estudios',
        'datos_estadisticos',
    ];

    protected $casts = [
        'cifras' => 'array',
        'plan_estudios' => 'array',
        'datos_estadisticos' => 'array',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function authorities()
    {
        return $this->hasMany(Authority::class);
    }
}