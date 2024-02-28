<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function listUsers(){
        $users = User::all(); // Fetch all registered users

        return View::make('pages.admin.users', compact('users'));
    }

    public function addUsers(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'bail'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['bail', 'required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'accountType' => '0'
        ]);


        return redirect ('pages.admin.users') -> with ('Success, User has been registered successfully');
    }

    public function addPage(){
        return view('pages.admin.addUser');
    }
    
    public function editUsers($id){
        $user = User::findOrFail($id);

        return view('pages.admin.edit', compact('user'));
    }

    public function amendUsers($id, Request $request){
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'bail'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'accountType' => 'user'
        ]);


        return redirect ('pages.admin.users') -> with ('Success, User has been updated registered ');
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user-> delete();

        return redirect()->back()->with('Success, User has been successfully deleted');

    }
}

