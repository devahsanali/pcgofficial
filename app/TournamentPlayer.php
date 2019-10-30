<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class TournamentPlayer extends Model {

    public function tournamentUser()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}

