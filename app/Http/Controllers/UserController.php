<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //Authenticate
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);
        $attemptResult = auth()->attempt($formFields);

        if($attemptResult){
            //$request->session()->regenerate();
            //dd($attemptResult);
            return Redirect::route('customers.index')->with('message','You have succesfully logged in');
            //return redirect('/')->with('message','You have succesfully logged in');
        }
        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }

    // public function index(){
    //     return User::all();
    // }
}
