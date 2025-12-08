<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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
}
