<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class MenuItem extends Model
{
    protected $fillable = ['menu_id', 'title', 'description', 'price'];

    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
