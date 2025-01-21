<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'pos_client';
    protected $primaryKey = 'client_id';
    protected $fillable = [
        'doc_type',
        'doc_number',
        'first_name',
        'last_name',
        'phone',
        'email',
    ];
    public $timestamps = false;
}