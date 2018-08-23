<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Thread;
use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('home', 'index', 'about', 'whatsnew', 'groups', 'search');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
    $title = 'Welcome to Click Side';
    if (!auth()->guest()) {
    $name = auth()->user()->name;
    } else {
    $name = 'Guest';
    }
    return view('pages.index', compact('title', 'name'));
    }

    public function index(Request $request)
    {   
      
        if ($request->has('tags')) {
            $threads=Thread::where('tags_id', $request->tags)->paginate(5);
        } 
      else {

        $threads=Thread::orderBy('created_at', 'desc')->paginate(5);
        }
        $tags=Tag::all();
        $count=count($tags);
        return view('pages.forum', compact('threads', 'tags', 'count')); 
    }

    public function about()
    {
    $title = 'About';
    return view('pages.about')->with('title', $title);
    }

    public function whatsnew()
    {
    $title = "What's New";
    $users=User::orderBy('created_at', 'desc')->paginate(5);
    $threads=Thread::orderBy('created_at', 'desc')->paginate(5);
      
    $comments=DB::table('comments')
        ->join('threads', 'comments.commentable_id', '=', 'threads.id')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->select('comments.*', 'threads.subject as title', 'users.name as name')
        ->paginate(5);
    return view('pages.whatsnew', compact('title', 'users', 'threads', 'comments'));
    }

    public function groups()
    {
    $title = "Groups (Coming Soon!)";
    return view('pages.groups')->with('title', $title);
    }

    public function search(Request $request)
    {
    $title = "Search";
    $query = $request->input('search');
    $usernames = DB::table('users')->where('name', 'LIKE', '%' . $query . '%')->paginate(10);
    $useremails = DB::table('users')->where('email', 'LIKE', '%' . $query . '%')->paginate(10);
    $titles = DB::table('threads')->where('subject', 'LIKE', '%' . $query . '%')->paginate(10);
    $subjects = DB::table('threads')->where('thread', 'LIKE', '%' . $query . '%')->paginate(10);      

    return view('pages.search', compact('title', 'usernames', 'useremails', 'titles', 'subjects', 'query'));
    }

}
