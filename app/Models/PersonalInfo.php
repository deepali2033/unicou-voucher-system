<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $table = 'personal_info';
    protected $primaryKey = 'personal_info_id';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'full_name',
        'date_of_birth',
        'email',
        'phone',
        'whatsapp',
        'address_line1',
        'address_line2',
        'city',
        'state_province',
        'country',
        'postal_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
