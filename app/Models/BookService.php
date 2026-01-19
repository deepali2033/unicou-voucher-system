<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookService extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'category_name',
        'service_name',
        'customer_name',
        'email',
        'phone',
        'street_address',
        'city',
        'state',
        'zip_code',
        'bedrooms',
        'bathrooms',
        'extras',
        'frequency',
        'square_feet',
        'booking_date',
        'booking_time',
        'parking_info',
        'flexible_time',
        'entrance_info',
        'pets',
        'special_instructions',
        'price',
        'status',
        'is_booking_confirmed',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'price' => 'decimal:2',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'is_booking_confirmed' => 'boolean',
    ];

    /**
     * Get the user who booked the service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the service that was booked.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
