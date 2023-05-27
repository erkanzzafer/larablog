<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    protected $fillable=[
        'subcategory_name',
        'slug',
        'parent_category',
        'ordering'];



        public function category()
        {
            return $this->belongsTo(Category::class, 'parent_category', 'id');
        }

        public function posts(){
            return $this->hasMany(Post::class,'category_id','id');
        }
}
