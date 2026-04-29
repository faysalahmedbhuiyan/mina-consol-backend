<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'product_name',
    'type',
    'sub_section',
    'country_name',
    'hs_code',
    'description',
    'price',
    'media'
];

protected $casts = [
    'media' => 'array'
];
}