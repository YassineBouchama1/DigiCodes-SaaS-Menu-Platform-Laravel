<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['type', 'url', 'mediable_id', 'mediable_type'];

    use HasFactory;

    public function mediable()
    {
        return $this->morphTo();
    }
}
