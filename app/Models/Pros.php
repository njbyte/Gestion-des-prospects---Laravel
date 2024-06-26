<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Notifications\Notifiable;

    class Pros extends Model
    {
        use HasFactory,Notifiable;
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
    }
