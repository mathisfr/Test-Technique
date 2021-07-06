<?php 

namespace App\Hubspot;

use Illuminate\Support\Facades\Schema;

class HubspotDeleteDatabase{
    /**
     * Permet de vider une table en base de données
     */
    static public function deleteTable(Array $models){
        for($i = 0; $i<count($models); $i++){
            $models[$i]::query()->delete();
            Schema::disableForeignKeyConstraints();
            $models[$i]::truncate();
            Schema::enableForeignKeyConstraints();
        }
    }
}