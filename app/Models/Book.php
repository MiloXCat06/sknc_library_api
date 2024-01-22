<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "Book";
    protected $fillable = [
        'title',
        'synopsis',
        'isbn',
        'writer',
        'page_amount',
        'stock_amount',
        'published',
        'category',
        'photo',
        'status',
    ];
}
