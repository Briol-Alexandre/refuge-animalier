<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Adopter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'tel',
    ];

    public function adoption() :HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function notes() :MorphMany
    {
        return $this->morphMany(Note::class, 'notable');
    }
}
