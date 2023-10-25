<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Validation\Rule;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Role;

// use Illuminate\Support\Facades\Gate; //不要。ミドルウェアで設定済み。Route::middleware


class ProfileController extends Controller
{

  public function index()
  {
    $users = User::all();
    return view('profiles.index', compact('users'));
  }

  public function show(User $user)
  {
    return view('profiles.show', compact('user'));
  }

  public function edit(User $user)
  {
    
    return view('profiles.edit', compact('user'));
  }

  public function update(Request $request, User $user)
  {
    // dd($request);
    // dd($user);
    $request->validate([
      'name' => 'required|string|max:255',
      // ignore メソッドによって現在のユーザーidの(email)を除外
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user)],
    ]);
    // $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();
    return redirect()->route('profile.show', $user)->with('update', 'アカウント情報を更新しました');
  }
  
}