<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Mockery\Matcher\Not;

class Adoption extends Model
{
    use HasFactory;

    protected $table = 'adoption';

    protected $fillable = [
        'animal_id',
        'adopter_id',
        'adoption_date',
        'status',
        'contact_message'
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function adopter(): BelongsTo
    {
        return $this->belongsTo(Adopter::class);
    }

    public function notes() :MorphMany
    {
        return $this->morphMany(Note::class, 'notable');
    }

    protected function casts(): array
    {
        return [
            'adoption_date' => 'date:Y-m-d',
        ];
    }
}
