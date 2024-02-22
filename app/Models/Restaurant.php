<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'address', 'opening_hour', 'closing_hour'];

    use HasFactory;

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
