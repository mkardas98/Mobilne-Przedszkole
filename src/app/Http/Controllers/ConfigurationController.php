<?php

namespace App\Http\Controllers;


use App\Models\Mail;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{

    public function editMail(Request $request)
    {
        $obj = Mail::first();

        if ($request->isMethod('post')) {
            $request->validate([
                'from_name' => 'required',
                'from_address' => 'required',
                'host' => 'required',
                'port' => 'required',
                'encryption' => 'required',
                'user_name' => 'required',
                'password' => 'required',
            ]);
            $form = $request->all();
            $obj->from_name = $form['from_name'];
            $obj->from_address = $form['from_address'];
            $obj->host = $form['host'];
            $obj->port = $form['port'];
            $obj->encryption = $form['encryption'];
            $obj->user_name = $form['user_name'];
            $obj->password = $form['password'];
            $obj->save();
        }


        return view('mail.edit', ['obj' => $obj]);

    }
}
