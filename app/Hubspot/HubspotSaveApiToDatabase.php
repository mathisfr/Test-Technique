<?php

namespace App\Hubspot;

use App\Models\Company;
use App\Models\Contact;

class HubspotSaveApiToDatabase{

    
    /**
     * Le token pour accéder à l'api.
     *
     * @var string
     */
    private $apiToken = "";
    
    // /**
    //  * Les propriétés qu'on veut récupérer de l'entreprise
    //  *
    //  * @var string
    //  */
    // private $properties =  "&properties=name
    //                         &properties=website
    //                         &properties=phone
    //                         &properties=annualrevenue
    //                         &properties=numberofemployees
    //                         &properties=industry
    //                         &properties=city
    //                         &properties=zip
    //                         &properties=country
    //                         &properties=description
    //                         ";
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
     */
    private function properties(array $arrayProperties){
    (array) $properties = implode("&properties=", $arrayProperties);
        $properties = '&properties='.$properties;
        return $properties;
    }

    /**
     * Fonction qui permet d'utiliser les autres fonctions de cette page pour enregistrer l'api en base de données
     * Les deux valeurs qu'il prend en parametres sont des models
     */
    public function apiToDatabase(){
        
        $companies = HubspotGetApi::getCompanies($this->properties($this->properties), $this->apiToken);
        $contact = HubspotGetApi::getContacts($companies, $this->apiToken);
        $none = 'Aucune information';

        for($i = 0; $i<count($companies); $i++){
                // $contact = new Contact();
                // $contact->firstName = $contacts[$i]['contacts'][0]['properties'][0]['value'] ?? $none;
                // $contact->lastName = $contacts[$i]['contacts'][0]['properties'][2]['value'] ?? $none;
                // $contact->phone = $none;
                // $contact->email = $contacts[$i]['contacts'][0]['identities'][0]['identity'][0]['value'] ?? $none;
                // $contact->save();

                $newContact = json_decode($contact[$i], true);
                // $this->info($newContact['contacts']['0']['properties']['0']['value'] ?? $none);

                $addContact = Contact::createFromApi($newContact, $none);
                
                Company::createFromApi($companies[$i], $addContact->id, $none);

                // $company = new Company();
                // $company->name = $companies[$i]['properties']['name']['value'] ?? $none;
                // $company->sector = $companies[$i]['properties']['industry']['value'] ?? $none;
                // $company->city = $companies[$i]['properties']['city']['value'] ?? $none;
                // $company->country = $companies[$i]['properties']['country']['value'] ?? $none;
                // $company->phone = $companies[$i]['properties']['phone']['value'] ?? $none;
                // $company->employers = $companies[$i]['properties']['numberofemployees']['value'] ?? 0;
                // $company->turnover = $companies[$i]['properties']['annualrevenue']['value'] ?? 0;
                // $company->website = $companies[$i]['properties']['website']['value'] ?? $none;
                // $company->zip = $companies[$i]['properties']['zip']['value'] ?? $none;
                // $company->description = $companies[$i]['properties']['description']['value'] ?? $none;
                // $company->contact_id = $contact->id;
                // $company->save();

        }
    }
}