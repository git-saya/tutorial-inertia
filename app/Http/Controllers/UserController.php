<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
  {
  	$title = 'User';
  	$users = User::orderBy('id', 'DESC')->get();
  	return Inertia::render('User/Index', [
  		'title' => $title,
  		'users' => $users
  	]);
  }

  public function show(User $user)
  {
  	#$user = User::find($id);
  	$title = 'Profile';
  	return Inertia::render('User/Detail', [
  		'title' => $title,
  		'user' => $user
  	]);
  }

  public function create()
  {
    $title = 'Register';
    return Inertia::render('User/Register', [
      'title' => $title
    ]);
  }

  public function store(Request $request)
  {
    /*
    cara pertama.
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();*/

    $request->validate([
      'name' => 'required',
      'email' => 'required|unique:users|email',
      'password' => 'required|min:8',
    ]);

    #carakedua.
    $post = $request->all();
    $post['password'] = Hash::make($request->password);
    User::create($post);

    return Redirect::route('user.index')->with('message', 'User created');
  }

  public function edit($id)
  {
    $user = User::find($id);
    $title = 'Edit Profile';
    return Inertia::render('User/Edit', [
      'title' => $title,
      'user' => $user
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email'
    ]);

    User::where('id', $id)
          ->update(['name' => $request->name, 
            'email' => $request->email]);

    return Redirect::route('user.index')->with('message', 'User updated');
  }

  public function destroy($id)
  {
    /*cara pertama.
    $user = User::find($id);
    $user->delete();*/

    #cara kedua.
    User::destroy($id);

    return Redirect::route('user.index')->with('message', 'User deleted');
  }
}
