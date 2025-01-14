<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['uuid', 'owner_uuid', 'name', 'description', 'active'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'uuid' => 'string',
        'owner_uuid' => 'string',
        'active' => 'integer'
    ];
}
