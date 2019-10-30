<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_role(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        return response()->json([
            'message' => 'Successfully created'
        ]);
    }
    
    public function get_roles(Request $request)
    {
        $role = Role::get();
        return response()->json($role);
    }

}
