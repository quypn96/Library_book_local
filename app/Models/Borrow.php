<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\BorrowStatusEnum;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'note',
    ];

    protected $attributes = [
        'status' => BorrowStatusEnum::PENDING
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrow_book', 'borrow_id', 'book_id');
    }
}
