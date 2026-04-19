<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'phone', 
        'mobile_phone', 
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define que a loja pode ter N produtos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}