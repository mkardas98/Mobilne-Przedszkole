<?php

namespace App\Http\Controllers;

use App\Forms\LessonPlanForm;
use App\Models\LessonPlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LessonPlansController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Request $request, $group_id, $id = 0)
    {
        $obj = ($id > 0) ? LessonPlan::find($id) : new LessonPlan();
        $form = new LessonPlanForm($obj);
        $teachers = User::where(function ($query) {
            $query->where('role', '=', '0')
                ->orWhere('role', '=', 1);
        })
            ->orderBy('last_name')
            ->get();

        if ($request->isMethod('post')) {

            $rules = [];

            foreach (LessonPlanForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }
            $request->validate($rules);

            $post = $request->all();

            $obj->group_id = $group_id;
            $obj->date = $post['date'];
            $obj->plan = $post['plan'];

            $obj->save();
            return redirect()->route('lesson_plan.edit',
                [
                    'id' => $obj->id,
                    'group_id' => $obj->group_id,
                    'obj' => $obj,
                    'teachers' => $teachers
                ]
            )->with('success', 'Zmiany zostały zapisane!');
        }
//        $obj->plan = json_decode($obj->plan);
        return view('lesson_plan.edit', [
            'obj' => $obj,
            'form' => $form,
            'group_id' => $group_id,
            'teachers' => $teachers

        ]);
    }

    public function show($id)
    {
        return view('lesson_plan.show', ['obj' => LessonPlan::find($id)]);
    }

    public function delete($id)
    {
        LessonPlan::find($id)->delete();
        return redirect()->back()->with('success', 'Plan dnia został usunięty!');
    }


}
