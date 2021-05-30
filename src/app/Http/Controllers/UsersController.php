<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
      ;
        if ($request->isMethod('post')) {
            $request->validate([
                'first_name' => 'required | max:16',
                'last_name' => 'required | max:16',
                'email' => 'required | unique:users,email,' . $id,
                'phone' => 'required | digits_between:9,16 | numeric',
                'pesel' => 'digits:11 | numeric',
                'date_of_birth' => 'required',
                'address' => 'min:3',
                'avatar' => 'file|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
                'role' => 'required',
            ]);

            $form = $request->all();

            if($form['role'] == '1' || $form['role'] == '0'){
                $request->validate([
                    'specialization' => '',
                ]);
            } else {
                $request->validate([
                    'child' => 'required',
                ]);
            }

            $obj->first_name = $form['first_name'];
            $obj->last_name = $form['last_name'];
            $obj->email = $form['email'];
            $obj->phone = $form['phone'];
            $obj->pesel = $form['pesel'];
            $obj->address = $form['address'];
            $obj->date_of_birth = $form['date_of_birth'];
            if(($id == Auth::user()->id) && (!($form['role'] == '0'))){
                return redirect()->route('director.users.edit',['id'=>$obj->id])->with('error', 'Nie możesz edytować swojego typu konta!');
            }
            if(($obj->role == 1 || $obj->role == 0) && $form['role'] == 2){
                UserGroup::where('user_id', $obj->id)->delete();
                $obj->specialization = '';
            } elseif (($obj->role == 2) && (($form['role'] == 1 || $form['role'] == 0))){
                $obj->child = 0;
            }

            if($form['role'] == 0 || $form['role'] == 1){
                $obj->specialization = $form['specialization'];
            } else {
                $obj->child = $form['child'];
            }

            $obj->role = $form['role'];
            $obj->first_name = $form['first_name'];

            if(isset($form['avatar'])){
             updateAvatar($form['avatar'], $obj);
            }



            if(($form['role'] == 2)){
                $obj->child = $form['child'];
            }

            if(!($obj->exists)){
                $obj->login = substr($form['first_name'], 0, 3) . substr($form['last_name'], 0, 3).date('mY', strtotime($form['date_of_birth']));
                $password = Str::random(10);
                $obj->password = Hash::make($password);
                $data['login'] =  $obj->login;
                $data['password'] = $password;
            }
            $obj->save();
            return redirect()->route('director.users.edit',['id'=>$obj->id])->with('success', 'Zmiany zostały zapisane!');
        }

        return view('users.edit', [
            'obj' => $obj
        ]);
    }

    public function delete($id)
    {

        dd($id);

    }

}
