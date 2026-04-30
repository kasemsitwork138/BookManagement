<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'author',
        'published_date',
        'category_id',
        'is_lend',
        'cover_image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function lendings()
{
    return $this->hasMany(LendingBook::class);
}

}
