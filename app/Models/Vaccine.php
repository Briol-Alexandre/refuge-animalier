<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specie_id',
    ];

    public function species():BelongsTo
    {
        return $this->belongsTo(Species::class, 'specie_id');
    }
}
