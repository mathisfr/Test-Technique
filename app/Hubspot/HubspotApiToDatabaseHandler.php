<?php

namespace App\Hubspot;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Support\Facades\Schema;

class HubspotApiToDatabaseHandler{
    private $hubspotApi;
    
    public function __construct(HubspotApi $hubspotApi){
        $this->hubspotApi = $hubspotApi;
    }
    
    /**
     * Fonction qui permet d'utiliser les autres fonctions de cette page pour enregistrer l'api en base de données
     * Les deux valeurs qu'il prend en parametres sont des models
     */
    public function apiToDatabase(): void
    {
        
        $companies = $this->hubspotApi->getCompanies();
        $contact = $this->hubspotApi->getContactsFromCompanies($companies);
        $none = 'Aucune information';

        for($i = 0; $i<count($companies); $i++){

                $newContact = json_decode($contact[$i], true);

                $addContact = Contact::createFromApi($newContact, $none);
                
                Company::createFromApi($companies[$i], $addContact->id, $none);

        }
    }

    /**
     * Permet de vider une table en base de données
     */
    static public function deleteTable(Array $models): void
    {
        for($i = 0; $i<count($models); $i++){
            $models[$i]::query()->delete();
            Schema::disableForeignKeyConstraints();
            $models[$i]::truncate();
            Schema::enableForeignKeyConstraints();
        }
    }
}