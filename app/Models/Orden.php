<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'pos_order';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'client_id',
        'total',
        'doc_type',
        'doc_number',
        'created_at'
    ];
    public $timestamps = false;
}