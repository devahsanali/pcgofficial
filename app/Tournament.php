<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
    protected $softDelete = true;

	public function images(){
        return $this->hasMany('App\Image', 'tournament_id', 'id');
    }

    public function type(){
        return $this->belongsTo('App\TournamentType', 'type_id', 'id');
    }

    public function tournamentPlayer(){
        return $this->hasMany('App\TournamentPlayer', 'tournament_id', 'id');
    }
    
}

