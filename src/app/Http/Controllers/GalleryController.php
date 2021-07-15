<?php

namespace App\Http\Controllers;

use App\Forms\GalleryForm;
use App\Forms\SeoForm;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $galleryItems = GalleryItem::where('gallery_id', '=', $obj->id)->get();
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
            if ($obj->seo) {
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
            'galleryItems' => $galleryItems,
            'form' => $form,
            'seoForm' => $seoForm
        ]);
    }

    public function addImages(Request $request, $id_gallery){


        $post = $request->all();
        $name = $post['name'];
        if(!$name){
            $name = '';
        }

        $gallery = Gallery::find($id_gallery);
           foreach ($post['images'] as $item){
               $filename = $item->getClientOriginalName();
               $filename = Filenameclean($filename);
               $dir = 'gallery/'.$id_gallery.'/';
               $destFilename = $dir . $filename;
               $destFilename = FileAvoidDuplicate($destFilename, Storage::disk('public'));
               Storage::disk('public')->put($destFilename, $item->get());

               $galleryItem = new GalleryItem();
               $galleryItem->name = $name;
               $galleryItem->url = $destFilename;
               $gallery->galleryItems()->save($galleryItem);
           }

        return back()->with('success', 'Zdjęcia zostały dodane!');


    }

    public function delete($id)
    {
       $gallery =  Gallery::find($id);
        $gallery->galleryItems()->delete();
        $gallery->delete();
        return redirect()->back()->with('success', 'Galeria została usunięta!');
    }

    public function deleteItem($id){
        GalleryItem::find($id)->delete();
        return redirect()->back()->with('success', 'Zdjęcie zostało usunięte!');

    }

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
