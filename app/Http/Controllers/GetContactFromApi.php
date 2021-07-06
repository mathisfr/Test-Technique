<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class GetContactFromApi extends Controller
{
    public function getContact(Request $request){
        $contact = Contact::where('id', $request->id)->first();
        return $contact;
    }
}
