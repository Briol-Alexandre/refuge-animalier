<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed_id',
        'sexe',
        'coat_id',
        'age',
        'desc',
        'status',
        'images',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function specie(): HasOneThrough
    {
        return $this->hasOneThrough(
            Species::class,
            Breed::class,
            'id',
            'id',
            'breed_id',
            'specie_id'
        );
    }

    public function coat(): BelongsToMany
    {
        return $this->belongsToMany(Coat::class, 'animal_coat', 'animal_id', 'coat_id');
    }

    public function vaccines(): BelongsToMany
    {
        return $this->belongsToMany(Vaccine::class, 'animal_vaccine', 'animal_id', 'vaccine_id');
    }

    public function adoption() :HasOne
    {
        return $this->hasOne(Adoption::class);
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'notable');
    }
}
