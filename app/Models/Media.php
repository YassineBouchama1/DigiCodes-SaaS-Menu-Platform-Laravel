<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $fillable = ['type', 'url', 'mediable_id', 'mediable_type'];

    use HasFactory;

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
