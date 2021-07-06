<?php

namespace App\Models;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    public function contact(){
        // Fait le lien avec la table "contacts" (model:Contact.php)
        return $this->belongsTo(Contact::class);
    }

    public static function createFromApi(array $companie,int $idContact, string $none)
    {
        $company = new self();
        $company->name = $companie['properties']['name']['value'] ?? $none;
        $company->sector = $companie['properties']['industry']['value'] ?? $none;
        $company->city = $companie['properties']['city']['value'] ?? $none;
        $company->country = $companie['properties']['country']['value'] ?? $none;
        $company->phone = $companie['properties']['phone']['value'] ?? $none;
        $company->employers = $companie['properties']['numberofemployees']['value'] ?? 0;
        $company->turnover = $companie['properties']['annualrevenue']['value'] ?? 0;
        $company->website = $companie['properties']['website']['value'] ?? $none;
        $company->zip = $companie['properties']['zip']['value'] ?? $none;
        $company->description = $companie['properties']['description']['value'] ?? $none;
        $company->contact_id = $idContact;
        $company->save();
    }
}
