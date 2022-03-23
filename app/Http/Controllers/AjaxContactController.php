<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class AjaxContactController extends Controller
{
    public function index()
    {
        return view('ajax-contact-us-form');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
          'name' => 'required',
          'email' => 'required|max:255',
          'message' => 'required'
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
		    $fileName = time() . '.' . $file->getClientOriginalExtension();
		    $file->storeAs('public/contacts', $fileName);
        }else{
            $fileName="no-image.png";
        }

        $save = new Contact;
        $save->name = $request->name;
        $save->email = $request->email;
        $save->message = $request->message;
        $save->image = $fileName;
        $save->save();

        return redirect('ajax-form')->with('status', 'Ajax Form Data Has Been validated and store into database');

    }

    public function contact()
    {
        return view('contact');
    }

    public function store_json(Request $request)
    {

        $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|max:255',
        'message' => 'required',
        'image' => 'file|max:8192|mimes:jpeg,png,jpg'

        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/contacts', $fileName);
        }else{
            $fileName="no-image.png";
        }


        $contactData = ['name' => $request->name, 'email' => $request->email,  'message' => $request->message, 'image' => $fileName];
        Log::info($contactData);
        Contact::create($contactData);
        return response()->json([
            'status' => 200,
        ]);
    }


}
