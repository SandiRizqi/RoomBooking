<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'slug',
        'description',
        'capacity',
        'price_per_day',
        'cover_image',
        'images',
        'color',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'price_per_day' => 'decimal:2',
    ];

    /**
     * Mutator: pastikan is_active disimpan sebagai string 'true'/'false'
     * agar PostgreSQL tidak error "boolean = integer" saat INSERT/UPDATE.
     */
    public function setIsActiveAttribute($value): void
    {
        $this->attributes['is_active'] = $value ? 'true' : 'false';
    }

    protected static function booted(): void
    {
        static::creating(function (Room $room) {
            if (empty($room->slug)) {
                $room->slug = Str::slug($room->name);
            }
        });
    }

    /**
     * Scope for active rooms.
     * Uses whereRaw for PostgreSQL boolean compatibility.
     * Avoids: "operator does not exist: boolean = integer"
     */
    public function scopeActive($query)
    {
        return $query->whereRaw('"is_active" = true');
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_facility');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price_per_day, 0, ',', '.');
    }
}
