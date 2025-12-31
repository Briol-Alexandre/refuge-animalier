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
        'notifiables_type',
        'notifiables_id',
        'read',
        'urgent',
        'type'
    ];

    protected function casts(): array
    {
        return [
            'read' => 'boolean',
        ];
    }

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
