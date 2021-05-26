<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

class ProfileController extends Controller
{
    public function show()
    {

        if (Auth::check()) {

            $profile = User::where('id', Auth::id())
                ->first();

            return view('profile.show', ['profile' => $profile]);

        }

        return redirect(route('login'));

    }

    public function editShow()
    {

        if (Auth::check()) {
            $profile = User::where('id', Auth::id())
                ->first();
            return view('profile.edit', ['profile' => $profile]);
        }

        return redirect(route('login'));

    }

    public function edit(Request $request)
    {

            $post = $request->all();

            $request->validate([
                'login' => 'required | max:16 | min:5 | unique:users,login,' . Auth::id(),
                'first_name' => 'required | max:16',
                'last_name' => 'required | max:16',
                'date_of_birth' => 'required',
                'phone' => 'required | max:16 | min:9',
                'email' => 'required | unique:users,email,' . Auth::id(),
                'avatar' => 'file|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
            ]);

            $user = User::where('id', Auth::id());

            if (isset($post['login'])) {
                $user->update(['login' => $post['login']]);
            }
            if (isset($post['first_name'])) {
                $user->update(['first_name' => $post['first_name']]);
            }
            if (isset($post['last_name'])) {
                $user->update(['last_name' => $post['last_name']]);
            }
            if (isset($post['date_of_birth'])) {
                $user->update(['date_of_birth' => $post['date_of_birth']]);
            }
            if (isset($post['phone'])) {
                $user->update(['phone' => $post['phone']]);
            }
            if (isset($post['email'])) {
                $user->update(['email' => $post['email']]);
            }

            if (isset($post['avatar'])) {
                $filename = $post['avatar']->getClientOriginalName();
                $filename = Filenameclean($filename);
                $dir = 'avatar/';
                $destFilename = $dir . $filename;
                $destFilename = FileAvoidDuplicate($destFilename, Storage::disk('public'));

                Storage::disk('public')->put($destFilename, $post['avatar']->get());
                $user->update(['avatar' => $destFilename]);
            }

            return redirect(route('profile_edit.show'))->with('success', 'Zmiany zostały zapisane!');

    }


}
