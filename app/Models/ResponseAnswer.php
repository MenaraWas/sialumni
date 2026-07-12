<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseAnswer extends Model
{
    //

    protected $fillable = [
        'alumni_response_id',
        'field_key',
        'field_label',
        'value',
    ];

    public function alumniResponse()
    {
        return $this->belongsTo(AlumniResponse::class);
    }
}
