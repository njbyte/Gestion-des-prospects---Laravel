<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pros extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'prospects';

    protected $fillable = [
        'name',
        'email',
        'status',
        // Other fields
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'integer',
    ];

    /**
     * Get the options for the activity log.
     *
     *
     */

    public function causer()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    public function subject()
    {
        return $this->morphTo();
    }
}
