<?php

namespace App\Http\Controllers;

use App\Forms\KidForm;
use App\Models\Kid;
use App\Models\User;
use Illuminate\Http\Request;

class KidsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function directorIndex()
    {
        $kids = Kid::with(['group', 'user'])->orderBy('last_name')->get();

        return view('director.kids.index', ['kids' => $kids]);
    }

    public function directorEdit(Request $request, $id = 0)
    {
        $obj = ($id > 0) ? Kid::find($id) : new Kid();
        $form = new KidForm($obj);

        if ($request->isMethod('post')) {

            $rules = [];

            foreach (KidForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }

            $request->validate($rules);

            $post = $request->all();

            $obj->first_name = $post['first_name'];
            $obj->last_name = $post['last_name'];
            $obj->pesel = $post['pesel'];
            $obj->date_of_birth = $post['date_of_birth'];
            $obj->first_name = $post['first_name'];

            Kid::where('user_id', $post['user_id'])
                ->update(['user_id' => 0]);
            $obj->user_id = $post['user_id'];
            $obj->group_id = $post['group_id'];

            if (isset($post['avatar'])) {
                updateAvatar($post['avatar'], $obj);
            }


            $obj->save();
            return redirect()->route('director.kids.edit', ['id' => $obj->id])->with('success', 'Zmiany zostały zapisane!');
        }

        return view('director.kids.edit', [
            'obj' => $obj,
            'form' => $form,
        ]);
    }

    public function directorDelete($id)
    {
        Kid::find($id)->delete();
        return redirect()->back()->with('success', 'Element został usunięty!');
    }

    public function directorShow($id)
    {
        $kid = Kid::with('group')->find($id);

        return view('director.kids.show', [
            'obj' => $kid
        ]);
    }


}
