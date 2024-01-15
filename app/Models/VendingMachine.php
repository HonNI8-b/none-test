<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendingMachine extends Model
{
    use HasFactory;

    protected $table = 'vending_machines';

    protected $fillable = [
        'date',
        'price',
        'image',
        'comment',
        'stock',
        'category_id'
    ];

}
