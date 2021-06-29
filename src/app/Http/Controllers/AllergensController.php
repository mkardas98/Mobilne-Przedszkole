<?php

namespace App\Http\Controllers;

use App\Forms\AllergenForm;
use App\Models\Allergen;
use App\Models\Kid;
use Illuminate\Http\Request;

class AllergensController extends Controller
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

    public function directorEdit(Request $request, $kid_id, $id = 0)
    {
        {
            $kid = Kid::find($kid_id);
            $obj = ($id > 0) ? Allergen::find($id) : new Allergen();
            $form = new AllergenForm($obj);

            if ($request->isMethod('post')) {

                $rules = [];

                foreach (AllergenForm::FIELDS as $field) {
                    $rules[$field['name']] = $field['rules'];
                }

                $request->validate($rules);
                $post = $request->all();

                $obj->allergen = $post['allergen'];
                $kid->allergens()->save($obj);

                return redirect()->route('director.allergens.edit',
                    [
                        'id' => $obj->id,
                        'kid_id'=>$kid->id,
                        'obj' => $obj
                    ]
                )->with('success', 'Zmiany zostały zapisane!');
            }

            return view('director.allergens.edit', [
                'obj' => $obj,
                'kid_id' =>$kid_id,
                'form' => $form,
            ]);
        }
    }

    public function directorDelete($id){
        Allergen::find($id)->delete();
        return redirect()->back();
    }
}
