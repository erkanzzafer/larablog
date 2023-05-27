<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
    'author_id',
    'category_id',
    'post_title',
    'post_slug',
    'post_content',
    'seo_baslik',
    'seo_etiket',
    'seo_icerik',
    'sayfa_gorsel'];
}
