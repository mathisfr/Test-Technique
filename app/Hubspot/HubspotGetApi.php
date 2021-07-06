<?php

namespace App\Hubspot;

use Illuminate\Support\Facades\Http;

class HubspotGetApi{

    /**
     * Fonction pour récupérer les contactes depuis une entreprise (Get Contacts at a Company: https://legacydocs.hubspot.com/docs/methods/companies/get_company_contacts)
     *
     * @return array
     */
    public static function getContacts(array $getCompanies, string $apiToken){
        $getContacts = [];

        for($i = 0; $i<count($getCompanies); $i++){
            $companiesId = $getCompanies[$i]['companyId'];
            $result = Http::accept('application/json')->get('https://api.hubapi.com/companies/v2/companies/'.$companiesId.'/contacts?hapikey='.$apiToken);
            array_push($getContacts,$result);
        }

        return  $getContacts;
    }

    /**
     * Fonction pour récupérer les entreprises avec toutes les propriétés utiliser dans l'application (Sorte: https://developers.hubspot.com/docs/api/crm/search)
     *
     * @return array
     */
    public static function getCompanies(string $properties, string $apiToken){
        $getCompanies = Http::accept('application/json')->get('https://api.hubapi.com/companies/v2/companies/paged?hapikey='.$apiToken.$properties);

        return  $getCompanies['companies'];
    }
}