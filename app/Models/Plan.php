<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    protected $fillable = ['name', 'description', 'max_menu_items', 'max_media', 'max_scans', 'price', 'duration'];

    use HasFactory;

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
