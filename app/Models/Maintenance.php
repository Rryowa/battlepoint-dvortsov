<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model {
    use HasFactory;

    protected $fillable = [
        'car_id', 'mileage', 'performed_at', 'cost', 'description'
    ];

    protected $casts = [
        'performed_at' => 'date'
    ];

    public function car(): BelongsTo {
        return $this->belongsTo(Car::class);
    }
}
