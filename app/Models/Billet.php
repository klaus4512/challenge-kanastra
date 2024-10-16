<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    use HasFactory;

    protected $table = 'billets';

    protected $fillable = [
        'debt_id',
        'debt_due_date',
        'debt_value',
        'email',
        'government_id',
        'name',
        'billet_generated_at',
        'billet_send_at',
    ];

    protected $casts = [
        'debt_due_date' => 'date',
        'debt_value' => 'decimal:2',
        'billet_generated_at' => 'datetime',
        'billet_send_at' => 'datetime',
    ];
}
