<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'make', 'model', 'year', 'price', 'status', 'dealership_id'
    ];
    public function dealership(): BelongsTo {
        return $this->belongsTo(Dealership::class);
    }

    public function maintenances(): HasMany {
        return $this->hasMany(Maintenance::class);
    }
}
