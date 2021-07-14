<?php

namespace App\Http\Controllers;

use App\Forms\KidForm;
use App\Forms\NewsForm;
use App\Forms\SeoForm;
use App\Models\Kid;
use App\Models\News;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function directorIndex()
    {
        $news = News::with(['seo'])->orderBy('created_at', 'desc')->get();
        return view('director.news.index', ['items' => $news]);
    }

    public function directorEdit(Request $request, $id = 0)
    {

        $obj = ($id > 0) ? News::with('seo')->find($id) : new News();

        $form = new NewsForm($obj);
        $seoForm = new SeoForm();
        if ($obj->seo) {
            $seoForm = new SeoForm($obj->seo);
        }

        if ($request->isMethod('post')) {
            $rules = [];
            $rulesSeo = [];
            foreach (NewsForm::FIELDS as $field) {
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

            return redirect()->route('director.news.edit', ['id' => $obj->id])->with('success', 'Zmiany zostały zapisane!');
        }

        return view('director.news.edit', [
            'obj' => $obj,
            'form' => $form,
            'seoForm' => $seoForm
        ]);
    }
//
    public function delete($id)
    {
        $news = News::find($id);
        $news->seo()->delete();
        $news->delete();
        return redirect()->back()->with('success', 'Element został usunięty!');
    }


}
