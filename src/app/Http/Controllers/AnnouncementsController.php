<?php

namespace App\Http\Controllers;

use App\Forms\AnnouncementForm;
use App\Models\Announcement;
use App\Models\Group;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
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


    public function directorEdit(Request $request, $group_id, $id = 0)
    {
        $obj = ($id > 0) ? Announcement::find($id) : new Announcement();
        $form = new AnnouncementForm($obj);

        if ($request->isMethod('post')) {

            $rules = [];

            foreach (AnnouncementForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }

            $request->validate($rules);
            $post = $request->all();
            $obj->group_id = $group_id;
            $obj->title = $post['title'];
            $obj->text = $post['text'];
            if (!isset($post['status'])) {
                $post['status'] = 0;
            } else {
                $obj->status = $post['status'];
            }

            $obj->save();
            return redirect()->route('director.announcement.edit',
                [
                    'id' => $obj->id,
                    'group_id' => $obj->group_id,
                    'obj' => $obj
                ]
            )->with('success', 'Zmiany zostały zapisane!');
        }

        return view('director.announcements.edit', [
            'obj' => $obj,
            'form' => $form,
            'group_id' => $group_id
        ]);
    }

    public function delete($id)
    {
        Announcement::find($id)->delete();
        return redirect()->back()->with('success', 'Ogłoszenie został usunięte!');
    }

    public function directorIndexGroup($id)
    {
        $item =  Group::find($id);
        $item->setRelation('announcements', $item->announcements()->orderBy('created_at', 'desc')->paginate(10));
        return view('director.announcements.group_index', ['item' => $item]);
    }

    public function directorIndex()
    {
        return view('director.announcements.index', ['items'=>Announcement::with('group')->orderBy('created_at', 'desc')->paginate(10)]);
    }

}
