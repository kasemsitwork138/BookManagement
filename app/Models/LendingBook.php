<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendingBook extends Model
{
    use HasFactory;
    protected $table = 'lending_book';

    protected $fillable = [
        'user_id',
        'book_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
