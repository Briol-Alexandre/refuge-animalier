<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Demand extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'email',
        'message',
    ];

    public function notifications(): MorphMany
    {
        return $this->morphMany(Notifications::class, 'notifiable');
    }
}
