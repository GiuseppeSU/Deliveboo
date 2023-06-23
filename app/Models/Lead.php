<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'email',
        'address',
        'price',
        'products'

    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);

    }
    
}
