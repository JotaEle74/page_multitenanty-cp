<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'name',
        'slug',
        'presentation',
        'prefinal',
        'objetivos',
        'resultados',
        'cifras',
    ];

    protected $casts = [
        'objetivos' => 'array',
        'resultados' => 'array',
        'cifras' => 'array',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
