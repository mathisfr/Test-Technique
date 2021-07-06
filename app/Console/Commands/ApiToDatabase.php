<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Company;
use App\Models\Contact;
// use App\Hubspot\HubspotGetApi;
use App\Hubspot\HubspotDeleteDatabase;
use App\Hubspot\HubspotSaveApiToDatabase;
use Illuminate\Console\Command;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Artisan;

class ApiToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:api-to-database';

    // /**
    //  * Le token pour accéder à l'api.
    //  *
    //  * @var string
    //  */
    // private $apiToken = "";

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

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Récupérer les propriétés des contacts et entreprises transmit par l\'api hubspot, puis les stockers dans la base de données avec une relation entre les contacts et les entreprises';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return string
     */
    public function handle()
    {
        // Models qu'on fait passer à la méthode deleteTable pour supprimer toutes les données de la table compagnies et contacts
        $models = [
            Company::class,
            Contact::class
        ];
        HubspotDeleteDatabase::deleteTable($models);

        // On récupère les données de l'api hubspot et on les enregistres en base de données
        $hubspotSaveApiToDatabase = new HubspotSaveApiToDatabase();
        $hubspotSaveApiToDatabase->apiToDatabase();
        
        return $this->info('La migration a été effectuée avec succès');
    }

    // /**
    //  * Fonction pour récupérer les contactes depuis une entreprise (Get Contacts at a Company: https://legacydocs.hubspot.com/docs/methods/companies/get_company_contacts)
    //  *
    //  * @return array
    //  */
    // private function getContacts(array $getCompanies){
    //     $getContacts = [];

    //     for($i = 0; $i<count($getCompanies); $i++){
    //         $companiesId = $getCompanies[$i]['companyId'];
    //         $result = Http::accept('application/json')->get('https://api.hubapi.com/companies/v2/companies/'.$companiesId.'/contacts?hapikey='.$this->apiToken);
    //         array_push($getContacts,$result);
    //     }

    //     return  $getContacts;
    // }

    // /**
    //  * Fonction pour récupérer les entreprises avec toutes les propriétés utiliser dans l'application (Sorte: https://developers.hubspot.com/docs/api/crm/search)
    //  *
    //  * @return array
    //  */
    // private function getCompanies(){
    //     $getCompanies = Http::accept('application/json')->get('https://api.hubapi.com/companies/v2/companies/paged?hapikey='.$this->apiToken.$this->properties);

    //     return  $getCompanies['companies'];
    // }

    // /**
    //  * Fonction qui permet d'utiliser les autres fonctions de cette page pour enregistrer l'api en base de données
    //  * Les deux valeurs qu'il prend en parametres sont des models
    //  */
    // private function apiToDatabase(){
    //     $this->info('En cours de migration...');

    //     $companies = HubspotGetApi::getCompanies($this->properties, $this->apiToken);
    //     $contact = HubspotGetApi::getContacts($companies, $this->apiToken);

    //     $none = 'Aucune information';

    //     for($i = 0; $i<count($companies); $i++){
    //             // $contact = new Contact();
    //             // $contact->firstName = $contacts[$i]['contacts'][0]['properties'][0]['value'] ?? $none;
    //             // $contact->lastName = $contacts[$i]['contacts'][0]['properties'][2]['value'] ?? $none;
    //             // $contact->phone = $none;
    //             // $contact->email = $contacts[$i]['contacts'][0]['identities'][0]['identity'][0]['value'] ?? $none;
    //             // $contact->save();

    //             $newContact = json_decode($contact[$i], true);
    //             // $this->info($newContact['contacts']['0']['properties']['0']['value'] ?? $none);

    //             $addContact = Contact::createFromApi($newContact, $none);
                
    //             Company::createFromApi($companies[$i], $addContact->id, $none);

    //             // $company = new Company();
    //             // $company->name = $companies[$i]['properties']['name']['value'] ?? $none;
    //             // $company->sector = $companies[$i]['properties']['industry']['value'] ?? $none;
    //             // $company->city = $companies[$i]['properties']['city']['value'] ?? $none;
    //             // $company->country = $companies[$i]['properties']['country']['value'] ?? $none;
    //             // $company->phone = $companies[$i]['properties']['phone']['value'] ?? $none;
    //             // $company->employers = $companies[$i]['properties']['numberofemployees']['value'] ?? 0;
    //             // $company->turnover = $companies[$i]['properties']['annualrevenue']['value'] ?? 0;
    //             // $company->website = $companies[$i]['properties']['website']['value'] ?? $none;
    //             // $company->zip = $companies[$i]['properties']['zip']['value'] ?? $none;
    //             // $company->description = $companies[$i]['properties']['description']['value'] ?? $none;
    //             // $company->contact_id = $contact->id;
    //             // $company->save();

    //     }
    // }

    // /**
    //  * Permet de vider une table en base de données
    //  */
    // private function deleteTable(Array $models){
    //     for($i = 0; $i<count($models); $i++){
    //         $models[$i]::query()->delete();
    //         Schema::disableForeignKeyConstraints();
    //         $models[$i]::truncate();
    //         Schema::enableForeignKeyConstraints();
    //         $this->info($models[$i].': tables vidées');
    //     }
    // }
}
