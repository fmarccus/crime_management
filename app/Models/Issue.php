<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Issue extends Model
{
    use HasFactory, Loggable;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
