<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'latitude', 'longitude', 'items', 'total'];
    // items = json array menu yang dipesan
    protected $casts = [
        'items' => 'array',
    ];
}
