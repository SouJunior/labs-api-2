<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['uuid', 'name', 'role', 'squad_uuid'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'uuid' => 'string',
        'name' => 'string',
        'role' => 'string',
        'squad_uuid' => 'string'
    ];

}
