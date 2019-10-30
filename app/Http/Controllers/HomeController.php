<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*$user = User::where('id', 1)->first();
        $role_r = Role::where('id', '=', 2)->firstOrFail();  
        $user->assignRole($role_r);
        dd($user->getRoleNames());*/
        //dd($role_r); 
       // Permission::create(['name' => 'admin']);        
        return view('home');
    }
}
