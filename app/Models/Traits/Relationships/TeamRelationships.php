<?php

namespace App\Models\Traits\Relationships;

use App\Models\Player;

trait TeamRelationships
{
    /**
     * Get the players associated with the team.
     */
    public function players()
    {
        return $this->belongsToMany(Player::class, 'team_player');
    }

    /**
     * Get the coach associated with the team.
     */
    public function coach() // Model to be created later
    {
        // return $this->belongsTo(Coach::class);
    }
}
