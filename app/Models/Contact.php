<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    public function company(){
        // Fait le lien avec la table "companies" (model:Company.php)
        return $this->hasOne(Company::class);
    }

    public static function createFromApi(array $newContact, string $none):Contact
    {
        $contact = new self();

        $contact->firstName = $newContact['contacts']['0']['properties']['0']['value'] ?? $none;
        $contact->lastName = $newContact['contacts']['0']['properties']['2']['value'] ?? $none;
        $contact->phone = $none;
        $contact->email = $newContact['contacts']['0']['identities']['0']['identity']['0']['value'] ?? $none;
        $contact->save();

        return $contact;
    }
    
}
