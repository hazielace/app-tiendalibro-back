<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    protected $table = 'pos_order_detail';
    protected $primaryKey = 'order_detail_id';
    protected $fillable = [
        'order_id',
        'book_id',
        'detail_price',
        'quantity',
    ];
    public $timestamps = false;
}
