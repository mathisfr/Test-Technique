<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HubspotController extends Controller
{
    public function hubspot(){

        // Depuis le model "Company.php" on récupere les entreprises et les contacts
        //$companies = Company::with('contact')->get();
        $companies = Company::all();

        // On passe les données à la vue et on affiche la vue      
        return Inertia::render('HubSpot/HubSpot.vue', [
            'companies' => $companies
        ]);
    }
}
