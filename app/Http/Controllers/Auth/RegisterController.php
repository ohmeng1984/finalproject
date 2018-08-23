<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

//      redirectTo property
//    protected $redirectTo = '/';
    protected function redirectTo()
    {
        if (!auth()->guest()) {
        return 'admin/routes';
        } else {
        return '/login';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest'||'admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|max:10',
            'g-recaptcha-response' => 'required|captcha',
            'cover_image' => 'nullable|string'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      
//$send = array('name'=>$data['name'], 'title'=>'Registration Complete', "content" => "Thanks for registering an account on Click Side! We hope you enjoy your stay.");
  
//Mail::send('emails.mail', $send, function($message) use ($data) {
  //  $message->to($data['email'], $data['name'])
    //        ->subject('Click Side Registration Confirmed');
//    $message->from('rommel.petilo@gmail.com','Admin');
//});    

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'cover_image' => $data['cover_image'],
        ]);
      

      
    }
}
