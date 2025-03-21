<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'dish_id', 'table_id', 'status'];

    // Define the relationship with Dish
    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }

    // Define the relationship with Table (optional, but recommended)
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}

