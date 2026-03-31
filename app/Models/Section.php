<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'section_type',
        'title',
        'subtitle',
        'content',
        'image',
        'order',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}