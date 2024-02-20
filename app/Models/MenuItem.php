<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['menu_id', 'title', 'description', 'price'];

    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
