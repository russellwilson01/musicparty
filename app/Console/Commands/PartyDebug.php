<?php

namespace App\Console\Commands;

use App\Models\Party;
use Illuminate\Console\Command;

class PartyDebug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'party:debug {party : The code of the party}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug output for party';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $code = $this->argument('party');
        $party = Party::whereCode($code)->first();
        if (!$party) {
            $this->output->error('Party not found');
            return self::FAILURE;
        }

        $this->output->writeln("Party {$party->code} Debug\n");
        $this->output->writeln("Playlist ID: {$party->playlist_id}");
        if ($party->user->status) {
            if ($party->user->status->item) {
                $this->output->writeln("Track: {$party->user->status->item->name}");
            }
            $this->output->writeln("\nDevice Status\n");
            dump($party->user->status->device);
            $this->output->writeln("\nContext\n");
            dump($party->user->status->context);
            $this->output->writeln("\nIs Playing\n");
            dump($party->user->status->is_playing);
        } else {
            dump($party->user->status);
        }
        return self::SUCCESS;
    }
}
