<?php

namespace App\Http\Controllers;

use App\Forms\AnnouncementForm;
use App\Models\Announcement;
use App\Models\Group;
use App\Models\Kid;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceListController extends Controller
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

    public function directorEdit(Request $request, $group_id, $date)
    {
        $kids = Kid::where('group_id', $group_id)->get();

        if ($request->isMethod('post')) {

            $post = $request->all();

            foreach ($post['attendance_list'] as $key => $item) {
                $kid = $kids->find($key);
                $_attendance_list = array();
                if ($kid->attendance_list == null) {
                    $kid->attendance_list = $_attendance_list;
                } else {
                    $_attendance_list = $kid->attendance_list;
                }

                $_attendance_list[$date] = $item[$date];
                $kid->attendance_list = $_attendance_list;
                $kid->save();
            }

            return redirect()->route('director.attendance_list.edit', [
                'kids' => $kids,
                'group_id' => $group_id,
                'date' => $date,
                ])->with('success', 'Zmiany zostały zapisane!');
        }


        return view('director.attendance_list.edit',
            [
                'kids' => $kids,
                'group_id' => $group_id,
                'date' => $date,
            ]);
    }


}
