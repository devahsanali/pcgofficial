<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\User;
use App\Http\Controllers\Controller;
use App\TournamentType;
use App\Tournament;
use App\Schedule;
use App\Image;
use App\TournamentPlayer;
class TournamentController extends Controller
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
    public function index()
    { 
        $tournaments = Tournament::with('images')->orderBy('id', 'desc')->paginate(25);
        return view('admin.tournament.manage')->with(['title' => 'Manage Tournament', 'tournaments' => $tournaments]);
    }

    public function details(Request $request){
      $tournament = Tournament::where('id', $request->id)->with(['images', 'type'])->orderBy('id', 'desc')->first();
      $player     = TournamentPlayer::where('tournament_id', $request->id)->with('tournamentUser')->get();
      $schedules  = Schedule::where('tournament_id', $request->id)->with(['scheduleUser1', 'scheduleUser2'])->get();
      return View('admin.tournament.detail')->with(['title' => 'Tournament Details', 'tournament' => $tournament, 'players' => $player, 'schedules' => $schedules]);      
    }

    public function add(Request $request)
    {   
    	$types = TournamentType::get();
        return view('admin.tournament.add')->with('types', $types);
    }

    public function post(Request $request)
    {   
    	/*$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);*/
        $tournament = new Tournament();
        $tournament->title          = $request->title;
        $tournament->type_id        = $request->type_id;
        $tournament->platform       = $request->platform;
        $tournament->start_date     = $request->start_date;
        $tournament->end_date       = $request->end_date;
        $tournament->entry_charges  = $request->entry_charges;
        $tournament->no_of_teams    = $request->no_of_teams;
        $tournament->no_of_players  = $request->no_of_players;
        $tournament->awarding_price = $request->awarding_price;
        $tournament->description    = $request->description;
        $tournament->save();

        $file = explode("~~",$request->fileName);
        for($i= 0; $i < count($file)-1; $i++){
            $img = new Image();
            $img->image = $file[$i];
            $img->tournament_id = $tournament->id;
            $img->save();
        }

        return "success";
    }

    public function edit(Request $request)
    {   
        $id = $request->id;
        $tournament = Tournament::with('images')->where('id', $id)->first();
        $types       = TournamentType::get();
        return view('admin.tournament.edit')->with(['types' => $types, 'tournament' => $tournament]);
    }

    public function update(Request $request)
    {   
        $id = $request->id;
        $tournament = Tournament::where('id', $id)->update([
            'title'          => $request->title,
            'type_id'        => $request->type_id,
            'platform'       => $request->platform,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'entry_charges'  => $request->entry_charges,
            'no_of_teams'    => $request->no_of_teams,
            'no_of_players'  => $request->no_of_players,
            'awarding_price' => $request->awarding_price,
            'description'    => $request->description
        ]);

        $files = $request->fileName;
        Image::where('tournament_id', $id)->delete();
        //upload new images
        $file = explode("~~",$files);
        for($i= 0; $i < count($file)-1; $i++){
            $img = new Image();
            $img->image = $file[$i];
            $img->tournament_id = $id; 
            $img->save();
        }
        return "success";
    }

    public function imageUpload(Request $request){
      $file = $request->file('file');
      $target_dir = env('PRODUCT_IMAGES');
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      
      $filename  = basename($_FILES['file']['name']);
      $extension = pathinfo($filename, PATHINFO_EXTENSION);
      $new       = $filename;
      move_uploaded_file($_FILES["file"]["tmp_name"], storage_path('tournament')."/{$new}");
          
      return $new;
    }

    public function removeImage(Request $request){
      $file = $request->file;
      $delete = File::delete(storage_path('tournament')."/".$file);
      Image::where('image', $file)->forceDelete();
      return 'true';
    }

    public function delete(Request $request){
      $tournament_id = $request->id;
      Tournament::where('id', $tournament_id)->delete();
      Image::where('tournament_id', $tournament_id)->delete();     
      return 'success';
    }

    public function status(Request $request){
      $tournament_id = $request->id;
      $tournament = Tournament::where('id', $tournament_id)->first();
      $status = ($tournament->status == 1) ? 0 : 1;
      Tournament::where('id', $tournament_id)->update(['status' => $status]);
      return 'success';
    }




}
