<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Logs extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow the default convention
    protected $table = 'activity_log';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'from',
        'to',
        'batch_uuid',
    ];

    // Cast attributes to native types
    protected $casts = [
        'properties' => 'array',
        'from' => 'datetime',
        'to' => 'datetime',
    ];


    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

}


