<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Runner;
use App\Models\Runner_cat;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function categorie()
    {
        $runners = Runner::all();

        foreach ($runners as $runner) {
            $categories = [];
            $currentYear = date('Y');
            $age = $currentYear - date('Y', strtotime($runner->dtn));

            if ($runner->genre === 'M') {
                $categories[] = Categorie::firstOrCreate(['nom_categorie' => 'Homme']);
            } elseif ($runner->genre === 'F') {
                $categories[] = Categorie::firstOrCreate(['nom_categorie' => 'Femme']);
            }

            if ($age < 18) {
                $categories[] = Categorie::firstOrCreate(['nom_categorie' => 'Junior']);
            }

            foreach ($categories as $category) {
                $existingAssociation = Runner_cat::where('id_runner', $runner->id)
                    ->where('id_categorie', $category->id)
                    ->exists();

                if (!$existingAssociation) {
                    Runner_cat::create(['id_runner' => $runner->id, 'id_categorie' => $category->id]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Coureur attribué avec succès à l\'étape.');


        //categorie des inserer
        // foreach ($runners as $runner) {
        //     $currentYear = date('Y');
        //     $age = $currentYear - date('Y', strtotime($runner->dtn));
        
        //     $categories = [];
        
        //     // Récupérez les catégories existantes en fonction du genre
        //     if ($runner->genre === 'M') {
        //         $categories[] = Categorie::where('nom_categorie', 'Homme')->first();
        //     } elseif ($runner->genre === 'F') {
        //         $categories[] = Categorie::where('nom_categorie', 'Femme')->first();
        //     }
        
        //     // Ajoutez la catégorie Junior si l'âge est inférieur à 18 ans
        //     if ($age < 18) {
        //         $categories[] = Categorie::where('nom_categorie', 'Junior')->first();
        //     }
        
        //     foreach ($categories as $category) {
        //         if ($category) { // Vérifiez si la catégorie existe avant de créer l'association
        //             $existingAssociation = Runner_cat::where('id_runner', $runner->id)
        //                 ->where('id_categorie', $category->id)
        //                 ->exists();
        
        //             if (!$existingAssociation) {
        //                 Runner_cat::create(['id_runner' => $runner->id, 'id_categorie' => $category->id]);
        //             }
        //         }
        //     }
        // }
    }
}
