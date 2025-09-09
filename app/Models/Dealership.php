<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Dealership extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'phoneNumber',
    ];

    protected $casts = [
        'phone_number' => 'encrypted:string',
    ];

    public function cars(): HasMany {
        return $this->hasMany(Car::class);
    }

    public function maintenances(): HasManyThrough {
        return $this->hasManyThrough(Maintenance::class, Car::class);
    }

    protected function phoneNumber(): Attribute {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['phone_number'] ?? null,
            set: fn ($value) => [ 'phone_number' => $value ]
        );
    }
}
