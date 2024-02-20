<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantInfo extends Model
{
    protected $fillable = ['user_id', 'name', 'address', 'opening_hour', 'closing_hour'];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
