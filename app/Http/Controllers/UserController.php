<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

class UserController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    return view('users.show', compact('user'));
  }

  public function edit()
  {
    $user = Auth::user();
    return view('users.edit', compact('user'));
  }

  public function update(Request $request)
  {
    // dd($request);
    // dd($user);
    $request->validate([
      'name' => 'required|string|max:255',
      // ignore メソッドによって現在のユーザー の id(email) を除外
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
    ]);
    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();
    return redirect()->route('user.show')->with('update', 'アカウント情報を更新しました');
  }

  public function passwordEdit()
  {
    $user = Auth::user();
    return view('users.passwordEdit', compact('user'));
  }

  public function passwordUpdate(Request $request)
  {
    $request->validate([
      'password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();
    // bcrypt() 関数で bcryptハッシュに変換
    $user->password = bcrypt($request->password);
    $user->save();

    return redirect()->route('user.passwordEdit')->with('update', 'パスワードを更新しました');
  }
}
