<?php

namespace App\Http\Controllers;

use App\Forms\EditPasswordForm;
use App\Forms\ProfileForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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


    public function edit(Request $request)
    {


        $user = Auth::user();
        $form = new ProfileForm($user);
        $formPassword = new EditPasswordForm($user);


        if($request->isMethod('post')){
            $rules = [];

            foreach (ProfileForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }
            $rules['email'][] = Rule::unique('users')->ignore($user->id);

            $request->validate($rules);

            $post = $request->all();
            $user->first_name = $post['first_name'];
            $user->last_name = $post['last_name'];
            $user->date_of_birth = $post['date_of_birth'];
            $user->address = $post['address'];
            $user->phone = $post['phone'];
            if(isset($post['pesel'])) {
                $user->pesel = $post['pesel'];
            }
            $user->email = $post['email'];

            if (isset($post['avatar'])) {
                updateAvatar($post['avatar'], $user);
            }
            $user->save();
            return redirect(route('profile.edit', [
                'profile' => $user,
                'form' => $form
            ]))->with('success', 'Zmiany zostały zapisane!');

        }

        return view('profile.edit', [
            'profile' => $user,
            'form' => $form,
            'formPassword' => $formPassword
        ]);


    }

    public function changePassword(Request $request)
    {

        $rules = [];

        foreach (EditPasswordForm::FIELDS as $field) {
            $rules[$field['name']] = $field['rules'];
        }
        $request->validate($rules);

        $user = Auth::user();

        if (!Hash::check($request['password'], $user->password)) {
            return back()->with('error', 'Aktualne hasło jest nieprawidłowe!');
        }

        $user->password = Hash::make($request['new_password']);
        $user->save();

        return back()->with('success', 'Hasło zostało zmienione!');
    }
}
