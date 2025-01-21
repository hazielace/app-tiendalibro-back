<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'pos_book';
    protected $primaryKey = 'book_id';
    protected $fillable = [
        'isbn',
        'name',
        'stock',
        'current_price',
    ];
    public $timestamps = false;
    
}
