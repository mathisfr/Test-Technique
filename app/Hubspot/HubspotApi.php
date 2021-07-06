<?php

namespace App\Hubspot;

use Illuminate\Support\Facades\Http;

class HubspotApi{
    /**
     * Le token pour accéder à l'api.
     *
     * @var string
     */
    private $apiToken = "";

    /**
    * Les propriétés qu'on veut récupérer de l'entreprise
    **/
    private $properties = [
        'name',
        'website',
        'phone',
        'annualrevenue',
        'numberofemployees',
        'industry',
        'city',
        'country',
        'description'
    ];

    public function __construct(){
        // On récupère le token dans .env par le fichier laravel.php dans le dossier config
        $this->apiToken = config('laravel.laravel_api_token');
    }

    /**
     * Fonction qui permet de concaténer le tableau $properties en chaine de caractère adapter pour l'utilisation de l'api
     * En ajoutant en plus le token d'accès à l'api
     */
    private function properties(array $arrayProperties): string
    {
    (array) $properties = implode("&properties=", $arrayProperties);
        $properties = '?hapikey='.$this->apiToken.'&properties='.$properties;
        return $properties;
    }

    /**
     * Fonction pour récupérer les contactes depuis une entreprise (Get Contacts at a Company: https://legacydocs.hubspot.com/docs/methods/companies/get_company_contacts)
     *
     * @return array
     */
    public function getContactsFromCompanies(array $companies): array
    {
        $getContacts = [];

        for($i = 0; $i<count($companies); $i++){
            $companiesId = $companies[$i]['companyId'];
            $result = Http::accept('application/json')->get('https://api.hubapi.com/companies/v2/companies/'.$companiesId.'/contacts?hapikey='.$this->apiToken);
            array_push($getContacts,$result);
        }

        return  $getContacts;
    }

    /**
     * Fonction pour récupérer les entreprises avec toutes les propriétés utiliser dans l'application (Sorte: https://developers.hubspot.com/docs/api/crm/search)
     *
     * @return array
     */
    public function getCompanies(): array
    {
        $getCompanies = Http::accept('application/json')->get('https://api.hubapi.com/companies/v2/companies/paged'.$this->properties($this->properties));

        return  $getCompanies['companies'];
    }
}