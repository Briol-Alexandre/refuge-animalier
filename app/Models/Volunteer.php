<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'name',
        'email',
        'tel',
    ];

    public function permissions():BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_volunteer');
    }
}
