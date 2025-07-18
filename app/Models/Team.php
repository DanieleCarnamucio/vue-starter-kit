<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Traits
use App\Models\Traits\Relationships\TeamRelationships;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory, TeamRelationships;

    protected $fillable = [

    ];
}
