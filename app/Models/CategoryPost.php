<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorypost extends Model
{
    use HasFactory;
    protected $table = 'category_post';
    public $fillable = ['category_id' ,'post_id'];
}
