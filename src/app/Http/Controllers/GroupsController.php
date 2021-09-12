<?php

namespace App\Http\Controllers;

use App\Forms\GroupForm;
use App\Models\Announcement;
use App\Models\Group;
use App\Models\Kid;
use App\Models\LessonPlan;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class GroupsController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    public function directorIndex()
    {
        $items = Group::with('users')->orderBy('name')->get();
        return view('director.groups.index', ['items' => $items]);
    }

    public function directorEdit(Request $request, $id = 0)
    {

        $obj = ($id > 0) ? Group::find($id) : new Group();


        if ($request->isMethod('post')) {
            $rules = [];

            foreach (GroupForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }

            $request->validate($rules);

            $post = $request->all();
            $obj->name = $post['name'];
            $obj->room = $post['room'];
            $obj->color = $post['color'];
            if (!isset($form['status'])) {
                $obj->status = 0;
            } else {
                $obj->status = 1;
            }

            $obj->save();

            $obj->users()->sync($post['teachers']);





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
        $form = new GroupForm($obj);


        return view('director.groups.edit', [
            'obj' => $obj,
            'form' => $form,
        ]);
    }

    function directorDelete($id)
    {
        Group::find($id)->delete();
        UserGroup::where('group_id', $id)->delete();
        Kid::where('group_id', $id)->update(['group_id'=> 0]);
        Announcement::where('group_id', $id)->delete();
        LessonPlan::where('group_id', $id)->delete();

        return redirect()->back()->with('success', 'Grupa została usunięta!');
    }

    public function directorShow($id)
    {

        $group = Group::with('users', 'kids.user', 'announcements', 'lessonPlan')->find($id);
        $group->announcements = $group->announcements->take(3);
        return view('director.groups.show', [
            'group' => $group,
        ]);
    }

}
