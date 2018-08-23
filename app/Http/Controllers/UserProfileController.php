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
  
  public function userprofileupdate(Request $request, $user)
  {
      $this->validate($request, [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
          'role' => 'required|string|max:10'
      ] );


      //Create Post
      $user = User::find($user);

      $user->update($request->all());
      return redirect('/')->with('success', 'User Details Updated');
  }
  
  public function passwordupdate(Request $request, $user)
  {
      $this->validate($request, [
          'password' => 'required|string|min:6|confirmed',
      ] );


      //Create Post
      $user = User::find($user);

      $user->password = bcrypt($request->get('password'));
      $user->save();
      return redirect()->back()->with('success', 'Password Updated');
  }
  
  public function updateprofilepicture(Request $request, $user)
  {
      $this->validate($request, [
        'cover_image' => 'image|nullable|max:1999',
      ] );

        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename =pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
    
      //Create Post
      $user = User::find($user);
      $user->cover_image=$fileNameToStore;
      $user->save();
      
      return redirect()->back()->with('success', 'User Details Updated');
  }
  
  
}
