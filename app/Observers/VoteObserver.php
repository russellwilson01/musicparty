<?php

namespace App\Observers;

use App\Models\Vote;
use Illuminate\Support\Facades\Log;

class VoteObserver
{
    /**
     * Handle the Vote "created" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function created(Vote $vote)
    {
        $vote->upcoming_song->updateVotes();
        Log::debug("[Party:{$vote->upcoming_song->party_id}] {$vote->user->nickname} has voted for {$vote->upcoming_song->song->name}");
    }

    /**
     * Handle the Vote "updated" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function updated(Vote $vote)
    {
        //
    }

    /**
     * Handle the Vote "deleted" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function deleted(Vote $vote)
    {
        $vote->upcoming_song->updateVotes();
    }

    /**
     * Handle the Vote "restored" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function restored(Vote $vote)
    {
        //
    }

    /**
     * Handle the Vote "force deleted" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function forceDeleted(Vote $vote)
    {
        //
    }
}
