<?php

namespace App\Http\Controllers;

use App\Forms\GalleryForm;
use App\Forms\SeoForm;
use App\Models\Gallery;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    public function directorIndex()
    {
        $items = Gallery::with('seo')->orderBy('created_at', 'desc')->get();
        return view('director.gallery.index', ['items' => $items]);
    }

    public function directorEdit(Request $request, $id = 0)
    {

        $obj = ($id > 0) ? Gallery::with('seo')->find($id) : new Gallery();

        $form = new GalleryForm($obj);
        $seoForm = new SeoForm();
        if ($obj->seo) {
            $seoForm = new SeoForm($obj->seo);
        }

        if ($request->isMethod('post')) {
            $rules = [];
            $rulesSeo = [];
            foreach (GalleryForm::FIELDS as $field) {
                $rules[$field['name']] = $field['rules'];
            }
            foreach (SeoForm::FIELDS as $field) {
                $rulesSeo[$field['name']] = $field['rules'];
            }
            $seo_id = null;
            if($obj->seo){
                $seo_id = $obj->seo->id;
            }
            $rulesSeo['seo_url'][] = Rule::unique('seo')->ignore($seo_id);

            $request->validate($rules);
            $request->validate($rulesSeo);

            $post = $request->all();
            if ($obj->seo) {
                $postSeo = [
                    'seo_url' => $post['seo_url'],
                    'seo_title' => $post['seo_title'],
                    'seo_description' => $post['seo_description'] ?? '',
                    'seo_tags' => $post['seo_tags'] ?? '',
                ];
                $obj->seo()->update($postSeo);
            } else {
                $seo = new Seo();
                $seo->seo_url = $post['seo_url'];
                $seo->seo_title = $post['seo_title'];
                $seo->seo_description = $post['seo_description'];
                $seo->seo_tags = $post['seo_tags'];
                $seo->save();
                $obj->seo_id = $seo->id;
            }

            $obj->title = $post['title'];
            $obj->lead = $post['lead'];
            $obj->text = $post['text'];
            if (isset($post['status'])) {
                $obj->status = $post['status'];
            } else {
                $obj->status = 0;
            }
            $obj->save();

            return redirect()->route('director.gallery.edit', ['id' => $obj->id])->with('success', 'Zmiany zostały zapisane!');
        }

        return view('director.gallery.edit', [
            'obj' => $obj,
            'form' => $form,
            'seoForm' => $seoForm
        ]);
    }

//
//    function directorDelete($id)
//    {
//        Group::find($id)->delete();
//        UserGroup::where('group_id', $id)->delete();
//        Kid::where('group_id', $id)->update(['group_id'=> 0]);
//        Announcement::where('group_id', $id)->delete();
//        LessonPlan::where('group_id', $id)->delete();
//
//        return redirect()->back()->with('success', 'Grupa została usunięta!');
//    }
//
//    public function directorShow($id)
//    {
//
//        $group = Group::with('users', 'kids.user', 'announcements', 'lessonPlan')->find($id);
//        $group->announcements = $group->announcements->take(3);
//        return view('director.groups.show', [
//            'group' => $group,
//        ]);
//    }

}
