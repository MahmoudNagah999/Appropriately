<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'title',
        'content' ,
    ];
    
    public function categories(){
        return $this->belongsToMany(Category::class,'post_category_pivot');
    }
}
