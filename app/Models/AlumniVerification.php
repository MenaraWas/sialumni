<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AlumniVerification extends Model
{
    //

    protected $fillable = [
        'alumni_response_id',
        'verified_by',
        'status',
        'note',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function alumniResponse()
    {
        return $this->belongsTo(AlumniResponse::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verifiedby');
    }
}
