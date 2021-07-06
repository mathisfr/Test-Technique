<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Company;
use App\Models\Contact;
use App\Hubspot\HubspotDeleteDatabase;
use App\Hubspot\HubspotSaveApiToDatabase;
use Illuminate\Console\Command;

class ApiToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:api-to-database';

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

}
