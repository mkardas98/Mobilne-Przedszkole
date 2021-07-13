<?php

namespace App\Http\Controllers;

use App\Forms\AnnouncementForm;
use App\Models\Announcement;
use App\Models\AttendanceList;
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

        foreach ($kids as $kid) {
            $_attendance_list = AttendanceList::where('date', '=', $date)
                ->where('kid_id', '=', $kid->id)
                ->first();
            if($_attendance_list != null){
                $kid->attendance_list = $_attendance_list->status;
            } else {
                $kid->attendance_list = null;
            }
        }


        if ($request->isMethod('post')) {

            $post = $request->all();
            foreach ($kids as $kid) {

                $kid->attendanceList()->UpdateOrCreate([
                        'kid_id' => $kid->id,
                        'date' => $date
                    ],
                        [
                            'status' => $post['attendance_list'][$kid->id]
                        ]
                    );
                $kid->attendance_list = $post['attendance_list'][$kid->id];
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
