<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Thread;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('home', 'index', 'about', 'whatsnew', 'groups');
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
            $threads=Thread::where('tags_id', $request->tags)->paginate(2);
        } else {

        $threads=Thread::orderBy('created_at', 'desc')->paginate(2);
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
    return view('pages.whatsnew')->with('title', $title);
    }

    public function groups()
    {
    $title = "Groups";
    return view('pages.groups')->with('title', $title);
    }


}
