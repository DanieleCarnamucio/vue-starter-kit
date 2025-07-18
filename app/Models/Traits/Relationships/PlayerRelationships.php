<?php

namespace App\Models\Traits\Relationships;

use App\Models\Team;

trait PlayerRelationships
{
    /**
     * Get the teams associated with the player.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_player');
    }

}
