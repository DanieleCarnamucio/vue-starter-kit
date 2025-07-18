<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Traits
use App\Models\Traits\Relationships\PlayerRelationships;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory, PlayerRelationships;

    protected $fillable = [
        'name',
        'surname',
        'birth_date',
    ];
}
