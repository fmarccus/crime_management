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
    public function complainant()
    {
        return $this->belongsTo(User::class);
    }
    public function investigator()
    {
        return $this->belongsTo(User::class);
    }
    public function persons()
    {
        return $this->hasMany(Person::class);
    }
    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
    public function getFullNameComplainant()
    {
        return $this->complainant->name . ' ' . $this->complainant->middlename . ' ' . $this->complainant->surname;
    }
    public function getFullNameInvestigator()
    {
        return $this->investigator->name . ' ' . $this->investigator->middlename . ' ' . $this->investigator->surname;
    }
    public function getFullNameOfficer()
    {
        return $this->user->name . ' ' . $this->user->surname;
    }
    protected $casts = ['date' => 'datetime'];
}
