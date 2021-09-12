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

    public function edit(Request $request, $group_id)
    {
        $obj = LessonPlan::with([])->where('group_id', '=', $group_id)->first() ??  new LessonPlan();
        if ($request->isMethod('post')) {

            $post = $request->all();
            $obj->group_id = $group_id;
            if(isset($post['plan'])){
                $obj->plan = $post['plan'];
            } else {
                $obj->plan = [];
            }
//
            $obj->save();
            return redirect()->route('director.lesson_plan.edit',
                [
                    'group_id' => $obj->group_id,
                    'obj' => $obj,
                ]
            )->with('success', 'Zmiany zostały zapisane!');
        }
//        $obj->plan = json_decode($obj->plan);
        return view('director.lesson_plan.edit', [
            'obj' => $obj,
            'group_id' => $group_id,
        ]);
    }


    public function delete($id)
    {
        LessonPlan::find($id)->delete();
        return redirect()->back()->with('success', 'Plan dnia został usunięty!');
    }


}
