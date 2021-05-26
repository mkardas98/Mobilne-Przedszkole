<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('profile.show', ['profile' => Auth::user()]);
    }

    public function editShow()
    {
        return view('profile.edit', ['profile' => Auth::user()]);
    }

    public function edit(Request $request)
    {

        $post = $request->all();

        $request->validate([
            'login' => 'required | max:16 | min:5 | unique:users,login,' . Auth::id(),
            'first_name' => 'required | max:16',
            'last_name' => 'required | max:16',
            'date_of_birth' => 'required',
            'phone' => 'required | max:16 | min:9 | numeric',
            'email' => 'required | unique:users,email,' . Auth::id(),
            'avatar' => 'file|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        $user = Auth::user();

        if (isset($post['login'])) {
            $user->login = $post['login'];
        }
        if (isset($post['first_name'])) {
            $user->first_name = $post['first_name'];
        }
        if (isset($post['last_name'])) {
            $user->last_name = $post['last_name'];
        }
        if (isset($post['date_of_birth'])) {
            $user->date_of_birth = $post['date_of_birth'];
        }
        if (isset($post['phone'])) {
            $user->phone = $post['phone'];
        }
        if (isset($post['email'])) {
            $user->email = $post['email'];
        }

        if (isset($post['avatar'])) {
            $filename = $post['avatar']->getClientOriginalName();
            $filename = Filenameclean($filename);
            $dir = 'avatar/';
            $destFilename = $dir . $filename;
            $destFilename = FileAvoidDuplicate($destFilename, Storage::disk('public'));

            Storage::disk('public')->put($destFilename, $post['avatar']->get());
            $user->avatar = $destFilename;
        }

        $user->save();

        return redirect(route('profile_edit.show'))->with('success', 'Zmiany zostały zapisane!');

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required'
            ],
            'new_password' => [
                'required',
                'min:6',
                'max:100',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
            'new_confirm_password' => [
                'same:new_password'
            ],
        ]);


        $user = Auth::user();

        if (!Hash::check($request['password'], $user->password)) {
            return back()->with('error', 'Aktualne hasło jest nieprawidłowe!');
        }

        $user->password = Hash::make($request['new_password']);
        $user->save();

        return back()->with('success', 'Hasło zostało zmienione!');
    }
}
