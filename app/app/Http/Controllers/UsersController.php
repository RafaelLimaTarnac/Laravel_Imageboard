<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obj = User::orderBy('role')->get();
		return View('users.index', ['users'=>$obj]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
		$obj = User::with('active_posts', 'queued_posts', 'comments.post')->findOrFail($id);
		return View('users.show', ['user'=>$obj, 'active'=>$obj->active_posts, 'queued'=>$obj->queued_posts, 'comments'=>$obj->comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
		
    }
	
	public function deleteUsers(Request $request){
		if(isset($request->delete_users)){
			foreach($request->delete_users as $id){
				$obj = User::findOrFail($id);
				if($obj->role == 'admin' || Auth::user()->role != 'admin' && $obj->role == 'manager')
					continue;
				$obj->delete();
			}
			return redirect()->back();
		}
		else
			return redirect()->back();
	}
}
