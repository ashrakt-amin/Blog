<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $fillable = ['title' , 'content' , 'user_id'];

    public function user(){
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
        }

        // polymorphic relation 

        public function photos(){
            return $this->morphMany(Photo::class , 'photoable');
        }
     
}
