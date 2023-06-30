<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Complainant extends Model
{
    use HasFactory, Loggable;

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
    public function getFullNameComplainant()
    {
        return $this->name. ' '. $this->middlename.' '.$this->surname; 
    }
}
