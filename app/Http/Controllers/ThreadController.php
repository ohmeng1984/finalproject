<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags=Tag::all();
        return view('thread.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $this->validate($request, [
                'subject' => 'required',
                'tags' => 'required',
                'thread' => 'required',
                /*'g-recaptcha-response' => 'required|captcha'*/
        ] );

        //Store
/*        $thread = new Thread;
        $thread->subject = $request->input('subject');
        $thread->type = $request->input('type');
        $thread->thread = $request->input('thread');
        $thread->save();*/
        $thread=auth()->user()->threads()->create($request->all());
        $thread->tags()->associate($request->tags);
        $thread->save();
        //Redirect
        return redirect('/forum')->with('success', 'Thread Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        $tags=Tag::all();
        return view('posts.index', compact('thread', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
/*        if(auth()->user()->id!==$thread->user_id)
        {
            return back()->with('error', 'Not Authorized!');
        }*/

        $this->authorize('update', $thread);
        $tags=Tag::all();
        return view('thread.edit', compact('thread', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $this->validate($request, [
                'subject' => 'required',
                'tags' => 'required',
                'thread' => 'required'
        ] );


        //Create Post
/*        $thread = Thread::find($id);
        $thread->subject = $request->input('subject');
        $thread->type = $request->input('type');
        $thread->thread = $request->input('thread');
        $thread->save();*/
        $thread->tags()->associate($request->tags);
        $thread->update($request->all());
        return redirect()->route('thread.show', $thread->id)->with('success', 'Thread Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();
        return redirect('/forum')->with('success', 'Thread Deleted');
    }

    public function markAsSolution()
    {

        $solutionId=Input::get('solutionId');
        $threadId=Input::get('threadId');
        $thread=Thread::find($threadId);
        $thread->solution=$solutionId;
        if ($thread->save()) {
            if(request()->ajax()){
                return response()->json(['status' => 'success', 'message' => 'Marked as Solution']);
            }

            return back()->with('success', 'Solution Marked');
        }
    }
}
