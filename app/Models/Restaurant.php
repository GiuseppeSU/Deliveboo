<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Restaurant extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function types()
    {
        return $this->belongsToMany(Type::class);

    }

    public function products() {
        return $this->hasMany(Product::class);
    }

   protected $fillable =[
        'id',
        'name',
        'address',
        'vat',
        'image',
        'slug',
        'user_id'
    ];

//prova con guarded
/*protected $guarded = [
    'remember_token',
    'updated_at',
    'created_at',
];
*/
}
