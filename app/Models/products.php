<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['item_code', 'image', 'productname', 'categoryId', 'price', 'details'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
}
