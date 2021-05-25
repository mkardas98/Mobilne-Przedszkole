<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {

        if(Auth::check()){

            $profile = User::where('id', Auth::id())
                ->first();

            return view('profile.show', ['profile'=>$profile]);

        }

        return redirect(route('login'));

    }

    public function editShow()
    {

        if(Auth::check()){
            $profile = User::where('id', Auth::id())
                ->first();
            return view('profile.edit', ['profile'=>$profile]);
        }

        return redirect(route('login'));

    }

    public function edit(Request $request) {
        $post = $request->all();
        if(isset($post['avatar'])){
            $filename = $post['avatar']->getClientOriginalName();
            $filename = Filenameclean($filename);
            $dir = 'avatar/';
            $destFilename = $dir.$filename;
            $destFilename = FileAvoidDuplicate($destFilename, Storage::disk('public'));
            Storage::disk('public')->put($destFilename, $post['avatar']->get() );
            User::where('id', Auth::id())
                ->update(['avatar'=> $destFilename]);
        }

        return redirect(route('profile.show'));

    }
}
