<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Redirect;
use App\User;
use App\Schedule;
use App\TournamentType;
use App\Tournament;
use App\TournamentPlayer;
class ScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
      //dd(User::role('player')->get());
      $tournament_id = $request->id;
      $validate_schedule = Schedule::where('tournament_id', $tournament_id)->get();
      if(!$validate_schedule->isEmpty()){
        return Redirect::back()->withErrors(['Already created.']);
      }

      $tournament = Tournament::with('tournamentPlayer')->where('id', $tournament_id)->first();
      if($tournament->no_of_players != $tournament->tournamentPlayer->count()){
         return Redirect::back()->withErrors(['No of player does not match requirement. (Required='.$tournament->no_of_players.', Registered='.$tournament->tournamentPlayer->count().')']);
      }
      $players = TournamentPlayer::with('tournamentUser')->where('tournament_id', $tournament_id)->get(); 

      $teams = $players->pluck('id')->toArray();
      $schedules = $this->roundRobin($teams);
      foreach($schedules as $schedule){
        foreach($schedule as $sched){
            $schedule = new Schedule();
            $schedule->tournament_id = $tournament_id;
            $schedule->user_id_1     = $sched['side1'];
            $schedule->user_id_2     = $sched['side2'];
            $schedule->save();
            
        }
      }
      return Redirect::back()->withSuccess(['Created Successfully']);

    }
    public function delete(Request $request){
        Schedule::where('tournament_id', $request->id)->delete();
        return Redirect::back()->withSuccess(['Deleted Successfully']);
    }
    public function roundRobin($teams){
        if (count($teams)%2 != 0){
            array_push($teams,"bye");
        }
        $side1 = array_splice($teams,(count($teams)/2));
        $side2 = $teams;
        for ($i=0; $i < count($side2)+count($side1)-1; $i++)
        {
            for ($j=0; $j<count($side2); $j++)
            {   if($side1[$j] != "bye" && $side2[$j] != "bye"){
                    $round[$i][$j]["side2"]=$side2[$j];
                    $round[$i][$j]["side1"]=$side1[$j];
                }
            }
            if(count($side2)+count($side1)-1 > 2)
            {
                $s = array_splice( $side2, 1, 1 );
                $slice = array_shift( $s  );
                array_unshift($side1,$slice );
                array_push( $side2, array_pop($side1 ) );
            }
        }
        return $round;
    }
}