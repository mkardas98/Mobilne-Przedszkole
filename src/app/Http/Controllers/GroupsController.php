<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use Carbon\Carbon;
use Faker\Provider\Address;
use Faker\Provider\DateTime;
use Faker\Provider\PhoneNumber;
use Faker\Provider\pl_PL\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GroupsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function directorIndex()
    {

//            $user = new User();
//            $user->login = 'user5';
//            $user->first_name = Person::firstNameFemale();
//            $user->last_name = Person::lastNameFemale();
//            $user->phone = PhoneNumber::numberBetween(100000000, 999999999);
//            $user->address = \Faker\Provider\pl_PL\Address::streetSuffix() . ' ' . \Faker\Provider\pl_PL\Address::postcode() . ' ' . \Faker\Provider\pl_PL\Address::citySuffix();
//            $user->pesel = Person::numberBetween(10000000000, 99999999999);
//            $user->date_of_birth = DateTime::date('Y-m-d');
//            $user->email = 'adres5@email.com';
//            $user->role = 2;
//            $user->password = bcrypt('user');
//            $user->created_at = Carbon::now();
//            $user->updated_at = Carbon::now();
//            $user->save();


        $items = Group::with('users')->orderBy('name')->get();

        return view('director.groups.index', ['items'=>$items]);
    }

    public function directorEdit(Request $request, $id = 0)
    {

        $obj = ($id > 0) ? Group::find($id) : new Group();

        $teachers = User::where(function ($query) {
            $query->where('role', '=', '0')
                ->orWhere('role', '=', 1);
        })
            ->orderBy('last_name')
            ->get();


        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required | max:40 | min:3',
                'room' => 'required | max:30',
                'teachers' => 'required',
            ]);

            $form = $request->all();
            $obj->name = $form['name'];
            $obj->room = $form['room'];
            $obj->color = $form['color'];
            if(!isset($form['status'])){
               $form['status'] = 0;
            }

            $obj->status = $form['status'];
            $obj->users()->sync($form['teachers']);
            $obj->save();

            return redirect()->route('director.groups.edit',['id'=>$obj->id])->with('success', 'Zmiany zostały zapisane!');
        }
        if(Group::find($id)){
            $obj->teachers = UserGroup::where('group_id', $obj->id)->get();
        }


        return view('director.groups.edit', [
            'teachers'=>$teachers,
            'obj' => $obj
        ]);
    }

    function directorDelete($id){
        Group::find($id)->delete();
        UserGroup::where('group_id', $id)->delete();

        return redirect()->route('director.groups.index')->with('success', 'Grupa została usunięta!');
    }

    public function directorShow($id)
    {
        $group = Group::with('users')->find($id);

        return view('director.groups.show', [
        'group'=>$group,
     ]);
    }

}
