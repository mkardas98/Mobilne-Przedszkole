<?php


namespace App\Http\Controllers;

use App\Forms\EditUsersForm;
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
        $form = new EditUsersForm($obj);

        if ($request->isMethod('post')) {


            $rules = [];

            foreach (EditUsersForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }
            $rules['email'][] = Rule::unique('users')->ignore($id);

            $request->validate($rules);

            $post = $request->all();

            if($post['role'] == '1' || $post['role'] == '0'){
                $request->validate([
                    'specialization' => '',
                ]);
            } else {
                $request->validate([
                    'child' => 'required',
                ]);
            }

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
            } elseif (($obj->role == 2) && (($post['role'] == 1 || $post['role'] == 0))){
                $obj->child = 0;
            }

            if($post['role'] == 0 || $post['role'] == 1){
                $obj->specialization = $post['specialization'];
            } else {
                $obj->child = $post['child'];
            }

            $obj->role = $post['role'];
            $obj->first_name = $post['first_name'];

            if(isset($post['avatar'])){
             updateAvatar($post['avatar'], $obj);
            }



            if(($post['role'] == 2)){
                $obj->child = $post['child'];
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
        return redirect()->route('director.users.index')->with('success', 'Konto zostało usunięte');
    }

}
