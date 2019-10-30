<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TournamentType;
use App\Tournament;

class SearchController extends Controller
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
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {  
        $type    = $request->type;
        $keyword = $request->keyword;
        if($type != '' && $keyword !=''){
            if($type == "tournament"){
                $tournament = Tournament::with('images')->where('title', 'Like', '%'.$keyword.'%')->orderBy('id', 'desc')->paginate(25);
                return View('admin.tournament.manage')->with(['title' => 'Search Tournament', 'tournaments' => $tournament]);      
            }
        }else{
            return redirect(route('admin.home'));
        }
    }

}

