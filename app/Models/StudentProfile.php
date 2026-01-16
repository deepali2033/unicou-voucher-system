<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'dob',
        'id_document_type',
        'id_document_no',
        'contact_no',
        'email',
        'detail_address',
        'city',
        'state',
        'country',
        'post_code',
        'whatsapp_no',
        'id_document_path',
        'purpose_of_exam',
        'highest_education',
        'passing_year',
        'preferred_countries',
        'bank_name',
        'bank_address',
        'bank_account_no',
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
