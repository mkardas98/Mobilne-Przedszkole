<?php

namespace App\Http\Controllers;

use App\Forms\AnnouncementForm;
use App\Forms\EatMenuForm;
use App\Models\Announcement;
use App\Models\AttendanceList;
use App\Models\EatMenu;
use App\Models\Group;
use App\Models\Kid;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EatMenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function directorIndex()
    {
        $items = EatMenu::all();
        return view('director.eat_menu.index', ['items' => $items]);
    }

    public function directorEdit(Request $request, $id = 0)
    {
        $obj = ($id > 0) ? EatMenu::find($id) : new EatMenu();
        $form = new  EatMenuForm($obj);

        if ($request->isMethod('post')) {

            $rules = [];

            foreach (EatMenuForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }
            $request->validate($rules);

            $post = $request->all();
            $obj->date = $post['date'];
            $obj->eats = $post['eats'];

            $obj->save();
            return redirect()->route('director.eat_menu.edit',
                [
                    'id' => $obj->id,
                    'obj' => $obj,
                    'form' => $form
                ]
            )->with('success', 'Zmiany zostały zapisane!');
        }
//        $obj->plan = json_decode($obj->plan);
        return view('director.eat_menu.edit', [
            'obj' => $obj,
            'form' => $form
        ]);
    }

    public function delete($id)
    {
        EatMenu::find($id)->delete();
        return redirect()->back()->with('success', 'Jadłospis został usunięty!');
    }

    public function directorShow($id)
    {
        return view('director.eat_menu.show', ['item'=>EatMenu::find($id)]);
    }


}
