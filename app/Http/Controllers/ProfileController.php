<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
    //権限付与用コード
    $admin = true;
    $roles = Role::all();
    return view('profiles.edit', compact('user', 'admin', 'roles'));
  }

  public function update(Request $request, User $user)
  {
    // dd($request);
    // dd($user);
    $request->validate([
      'name' => 'required|string|max:255',
      // ignore メソッドによって現在のユーザーidの(email)を除外
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user)],
      // 'remark' => 'max:500',
      'remark' => 'max:501',
      'role_id' => 'required|in:1,2', // 1: admin, 2: user
    ]);

    // $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->remark = $request->remark;
    // 役割を更新
    $user->roles()->sync([$request->role_id]);

    $user->save();
    
    return redirect()->route('profile.show', $user)->with('update', 'アカウント情報を更新しました');
  }
  
}