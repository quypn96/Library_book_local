<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name',
        'parent_id',
        'status',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category', 'cate_id', 'book_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('categories');
    }
}
