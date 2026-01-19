<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'dob',
        'id_type',
        'id_no',
        'phone',
        'email',
        'whatsapp',
        'address',
        'city',
        'state',
        'country',
        'post_code',
        'id_document',
        'exam_purpose',
        'highest_education',
        'passing_year',
        'preferred_countries',
        'bank_name',
        'bank_country',
        'account_no',
        're_upload_id_document',
    ];

    protected $casts = [
        'preferred_countries' => 'array',
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
