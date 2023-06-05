<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $fillable=[
        'name','slug','content','photo','category','publish_date'
    ];
    use HasFactory;


    public function scopeSearch($query,$term){
        $term="%$term%";
        $query->where(function($query) use ($term){
            $query->where('post_title','like',$term);
        });
    }

}
