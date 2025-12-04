<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'read',
        'urgent'
    ];

    protected function casts(): array
    {
        return [
            'read' => 'boolean',
        ];
    }
}
