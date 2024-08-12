<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['name_ar', 'name_en', 'price', 'description_ar', 'description_en', 'image', 'created_at', 'updated_at'] ;
    protected $hidden = ['created_at','updated_at'] ;
}
