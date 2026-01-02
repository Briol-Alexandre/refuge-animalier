<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notifiable_type',
        'notifiable_id',
        'read',
        'urgent',
        'type'
    ];

    protected function casts(): array
    {
        return [
            'read' => 'boolean',
            'urgent' => 'boolean'
        ];
    }

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
