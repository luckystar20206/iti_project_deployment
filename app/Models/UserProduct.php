<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id'
    ];

    protected $table = 'user_product';
    public $timestamps = false;
    
}
