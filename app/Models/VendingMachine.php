<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Category;

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

    public function category() : Relation {
        return $this->belongsTo(Category::class);
    }

}
