<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tag;
use Illuminate\Support\Facades\DB;
use App\Thread;
use App\Comment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $tags=Tag::all();
        $threads=DB::table('threads')
            ->join('users', 'threads.user_id', '=', 'users.id')
            ->select('threads.*', 'users.name as name')
            ->get();
        $comments=DB::table('comments')
            ->join('threads', 'comments.commentable_id', '=', 'threads.id')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'threads.subject as title', 'users.name as name')
            ->get();
        return view('admin', compact('tags', 'threads', 'comments'));
    }

    public function viewusers()
    {
        $users=User::all();
        return view('admin.viewusers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addtopic(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ] );
        $tags=Tag::create($request->all());

        $tags->save();
        //Redirect
        return redirect('admin/routes')->with('success', 'Tag Added');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordupdate(Request $request, $user)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ] );


        //Create Post
        $user = User::find($user);

        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->route('viewusers')->with('success', 'Password Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:10'
        ] );


        //Create Post
        $user = User::find($user);

        $user->update($request->all());
        return redirect()->route('viewusers')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {

        $user = User::find($user);
        $user->delete();
        return redirect('admin/routes')->with('success', 'User Deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletetopic($id)
    {

        $tag = Tag::find($id);
        $tag->delete();
        return redirect('admin/routes')->with('success', 'Tag Deleted');
    }

    public function destroythread($id)
    {

        $thread = Thread::find($id);
        $thread->delete();
        return redirect('admin/routes')->with('success', 'Thread Deleted');
    }

    public function destroycomment($id)
    {

        $comment = Comment::find($id);
        $comment->delete();
        return redirect('admin/routes')->with('success', 'Comment Deleted');
    }
}
