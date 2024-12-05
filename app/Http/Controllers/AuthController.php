<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\User;


class AuthController extends Controller
{
    
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'nullable|string|max:15',
            'pro_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $proPicPath = null;
        if ($request->hasFile('pro_pic')) {
            $file = $request->file('pro_pic');
            $proPicPath = $file->storeAs('profile_pictures',  Str::uuid() . '.' . $file->getClientOriginalExtension(), 'public' );
        }

        $user = User::create([
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'name' => $validatedData['fname']." ".$validatedData['lname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null,
            'pro_pic' => $proPicPath,
            'password' => Hash::make($validatedData['password']),
        ]);


        Auth::login($user);

        flash()->success('Registration successful! Welcome to Bartavai.');
        return redirect()->route('home');

    }

    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            flash()->success('Welcome to Bartavai!');
            return redirect()->route('home');
        }
        
        
        flash()->error('Email or Password may be wrong.');
        return back()->withInput();

    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }




    public function showProfile(){
        return view(view: 'auth.profile');
    }



    public function editProfile(){
        return view(view: 'auth.edit-profile');
    }




    public function updateProfile(Request $request){

        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'bio'   => 'nullable|string'
        ]);

        $validatedData['name'] = $validatedData['fname']. " " . $validatedData['lname'];

        $user = User::where('id', Auth::user()->id)->first();
        $user->update($validatedData);

        flash()->success('Profile updated successfully!');
        return back();
    }


    public function updatePassword(){
        //
    }



}
