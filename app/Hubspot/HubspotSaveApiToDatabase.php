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

                $newContact = json_decode($contact[$i], true);

                $addContact = Contact::createFromApi($newContact, $none);
                
                Company::createFromApi($companies[$i], $addContact->id, $none);

        }
    }
}