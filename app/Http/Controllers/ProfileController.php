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
  
}