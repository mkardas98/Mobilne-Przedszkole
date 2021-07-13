<?php

namespace App\Http\Controllers;


use App\Forms\BasicFieldsForm;
use App\Models\BasicFields;
use Illuminate\Http\Request;

class BasicFieldsController extends Controller
{
    private function edit($post)
    {
        foreach ($post as $name => $value) {
            if($name != "_token"){
            (new \App\Models\BasicFields())->UpdateOrCreate([
                'name' => $name
            ],
                [
                    'value' => $value
                ]);
            };
        }
    }

    public function kindergartenDataEdit(Request $request)
    {
        $basicFields = BasicFields::all()->pluck('value', 'name')->toArray();
        $form = new BasicFieldsForm();

        foreach ($form->fields as $key=>$field) {
            $form->fields[$key]['value'] = $basicFields[$field['name']] ?? '';
        }

        if ($request->isMethod('post')) {
            $post = $request->all();
            $this->edit($post);
            return redirect(route('director.kindergarten_data.edit'))->with('success', 'Zmiany zostały zapisane!');
        }
        return view('director.kindergarten_data.edit', [
            'form' => $form,
        ]);
    }



}
