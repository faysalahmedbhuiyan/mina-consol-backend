<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
    'course_name',
    'details',
    'instructor_name',
    'section',
    'media',
    'pdf'
];

protected $casts = [
    'media' => 'array',
];
}