<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //

    public function page(){
        return view('user.contact.contact');
    }

    public function inbox(){

        $data = Contact::orderBy('created_at','desc')->get();
        return view('admin.contact.inbox',compact('data'));
    }

    public function delete($id){

        $data = Contact::where('id',$id)->delete();
        return back();
    }
}
