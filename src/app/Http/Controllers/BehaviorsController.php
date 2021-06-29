<?php

namespace App\Http\Controllers;

use App\Forms\BehaviorForm;
use App\Forms\GroupForm;
use App\Models\Behavior;
use App\Models\Group;
use App\Models\Kid;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class BehaviorsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function directorEdit(Request $request, $kid_id, $id = 0)
    {

        $obj = ($id > 0) ? Behavior::find($id) : new Behavior();
        $kid = Kid::find($kid_id);

        if ($request->isMethod('post')) {
            $rules = [];

            foreach (BehaviorForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }

            $request->validate($rules);

            $post = $request->all();
            $obj->kid_id = $kid_id;
            $obj->type = $post['type'];
            $obj->text = $post['text'];
            $obj->save();
            return redirect()->route('director.behaviors.edit', ['id' => $obj->id, 'kid_id' => $kid_id])->with('success', 'Zmiany zostały zapisane!');
        }

        $form = new BehaviorForm($obj);


        return view('director.behaviors.edit', [
            'obj' => $obj,
            'form' => $form,
            'kid_id' => $kid_id
        ]);
    }

    public function delete($id)
    {
        Behavior::find($id)->delete();
        return redirect()->back()->with('success', 'Wpis zachowania został usunięty!');
    }




}
