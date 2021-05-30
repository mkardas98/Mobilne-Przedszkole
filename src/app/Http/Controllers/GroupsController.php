<?php

namespace App\Http\Controllers;

use App\Forms\GroupsForm;
use App\Forms\ProfileForm;
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
use Illuminate\Validation\Rule;

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

        return view('director.groups.index', ['items' => $items]);
    }

    public function directorEdit(Request $request, $id = 0)
    {

        $obj = ($id > 0) ? Group::find($id) : new Group();


        if ($request->isMethod('post')) {
            $rules = [];

            foreach (GroupsForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }

            $request->validate($rules);

            $form = $request->all();
            $obj->name = $form['name'];
            $obj->room = $form['room'];
            $obj->color = $form['color'];
            if (!isset($form['status'])) {
                $form['status'] = 0;
            }

            $obj->status = $form['status'];
            $obj->save();

            $obj->users()->sync($form['teachers']);





            return redirect()->route('director.groups.edit', ['id' => $obj->id])->with('success', 'Zmiany zostały zapisane!');
        }

        if (Group::find($id)) {
            $currentTeachers = UserGroup::where('group_id', $obj->id)->get();
            $teachers = array();
            foreach ($currentTeachers as $currentTeacher) {
                array_push($teachers, $currentTeacher->user_id);
            }
            $obj->teachers = array_unique($teachers);

        }
        $form = new GroupsForm($obj);


        return view('director.groups.edit', [
            'obj' => $obj,
            'form' => $form,
        ]);
    }

    function directorDelete($id)
    {
        Group::find($id)->delete();
        UserGroup::where('group_id', $id)->delete();

        return redirect()->route('director.groups.index')->with('success', 'Grupa została usunięta!');
    }

    public function directorShow($id)
    {
        $group = Group::with('users')->find($id);

        return view('director.groups.show', [
            'group' => $group,
        ]);
    }

}
