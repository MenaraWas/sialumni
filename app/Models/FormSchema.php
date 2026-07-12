<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormSchema extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'fields',
        'is_active'
    ];

    protected $casts = [
        'fields' => 'array',
        'is_active' => 'boolean',
    ];

    public function alumniResponses(): HasMany{
        return $this->hasMany(AlumniResponse::class);
    }

    public static function booted(): void{
        static::saving(function(FormSchema $schema) {
            if ($schema->is_active){
                static::where('id', '!=', $schema->id)->update(['is_active' => false]);
            }
        });
    }

    public static function getActive(): ?self{
        return static::where('is_active', true)->first();
    }
}
