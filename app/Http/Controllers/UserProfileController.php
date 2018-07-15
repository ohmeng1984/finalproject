<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Comment;
use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(User $user)
	{
		$threads=Thread::where('user_id', $user->id)->latest()->get();

		$comments=Comment::where('user_id', $user->id)->where('commentable_type', 'App\Thread')->latest()->get();

		return view('profile.index', compact('user', 'threads', 'comments'));
	}
}
