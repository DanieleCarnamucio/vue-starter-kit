<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Player;
use Carbon\Carbon;

class TeamPlayerSeeder extends Seeder
{
    public function run(): void
    {
        $teams = Team::all();
        $players = Player::all();

        foreach ($teams as $team) {
            $selectedPlayers = $players->random(rand(1,5));

            $attachData = [];

            foreach ($selectedPlayers as $player) {
                $joinedAt = Carbon::today()->subYears(rand(0, 50));
                $leftAt = $joinedAt->copy()->addYears(rand(0, 10));

                if ($leftAt > Carbon::today()) {
                    $leftAt = null;
                }

                $attachData[$player->id] = [
                    'joined_at' => $joinedAt->format('Y'),
                    'left_at' => $leftAt ? $leftAt->format('Y') : null
                ];
            }

            // Attach all players with pivot data in a single query
            $team->players()->attach($attachData);
        }
    }
}
