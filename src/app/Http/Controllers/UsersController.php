<?php


namespace App\Http\Controllers;

use App\Forms\UserForm;
use App\Mail\NewUserMail;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UsersController extends Controller {

    public function index() {

        $users = User::select('*')->orderBy('last_name')->get();
        return view('users.index', [
            'users'=>$users,
        ]);
    }

    public function edit(Request $request, $id = 0)
    {

        $obj = ($id > 0) ? User::find($id) : new User();
        $form = new UserForm($obj);

        if ($request->isMethod('post')) {

//            dd($request->all());
            $rules = [];

            foreach (UserForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }
            $rules['email'][] = Rule::unique('users')->ignore($id);

            $request->validate($rules);

            $post = $request->all();

            $obj->first_name = $post['first_name'];
            $obj->last_name = $post['last_name'];
            $obj->email = $post['email'];
            $obj->phone = $post['phone'];
            $obj->pesel = $post['pesel'];
            $obj->address = $post['address'];
            $obj->date_of_birth = $post['date_of_birth'];
            if(($id == Auth::user()->id) && (!($post['role'] == '0'))){
                return redirect()->route('director.users.edit',['id'=>$obj->id])->with('error', 'Nie możesz edytować swojego typu konta!');
            }
            if(($obj->role == 1 || $obj->role == 0) && $post['role'] == 2){
                UserGroup::where('user_id', $obj->id)->delete();
                $obj->specialization = '';
            }
            if($post['role'] == 0 || $post['role'] == 1){
                $obj->specialization = $post['specialization'];
            }

            $obj->role = $post['role'];

            if(isset($post['avatar'])){
             updateAvatar($post['avatar'], $obj);
            }


            if(!($obj->exists)){
                $obj->login = substr($post['first_name'], 0, 3) . substr($post['last_name'], 0, 3).date('mY', strtotime($post['date_of_birth']));
                $password = Str::random(10);
                $obj->password = Hash::make($password);
                $data = [];
                $data['login'] =  $obj->login;
                $data['password'] = $password;
                Mail::to($post['email'])->send(new NewUserMail($data, 'Dane do logowania - Mobilne Przedszkole' ));

            }
            $obj->save();
            return redirect()->route('director.users.edit',['id'=>$obj->id])->with('success', 'Zmiany zostały zapisane!');
        }

        return view('users.edit', [
            'obj' => $obj,
            'form' => $form,
        ]);
    }

    public function delete($id)
    {

        User::find($id)->delete();
        UserGroup::where('user_id', $id)->delete();
        return redirect()->back()->with('success', 'Konto zostało usunięte');
    }

}
