<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $is_user = User::where('email', $user->getEmail())->first();

            if ($is_user) {
                Auth::login($is_user, true); // Login the user and "remember" the session

                // Check user role and redirect accordingly
                if ($is_user->role == '0') {
                    return redirect()->route('home'); // Replace 'admin.dashboard' with the actual route name for the admin dashboard
                } elseif ($is_user->role == '1') {
                    return redirect()->route('program-chair.index'); // Replace 'program.page' with the actual route name for the program page
                } elseif ($is_user->role == '2') {
                    return redirect()->route('librarian.dashboard'); // Replace 'librarian.dashboard' with the actual route name for the librarian dashboard
                } elseif ($is_user->role == '3') {
                    return redirect()->route('faculty.dashboard'); // Replace 'faculty.dashboard' with the actual route name for the faculty dashboard
                }

                return redirect()->route('licoms')->with('error', 'Sorry, your email is not authorized to enter this page!');
            
        } else {
            return redirect()->route('licoms')->with('error', 'Sorry, your email is not authorized to enter this page!');
            //return "Your email is not eligible for the website.";
        }
        
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout()
    {
        Auth::logout();

        // Clear the remember token from the session cookie
        $cookie = cookie(Auth::getRecallerName());
        return redirect()->route('licoms')->withCookie($cookie)->with('success', 'You have been logged out successfully.');
    }
}
