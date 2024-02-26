<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    protected $fillable = [
        'restaurant_id',
        'count_menu_items',
        'count_media',
        'count_scans'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
