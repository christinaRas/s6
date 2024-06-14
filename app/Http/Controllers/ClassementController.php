<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Etape;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassementController extends Controller
{
    public function classementEtape2()
    {
        $classement = DB::table('v_classement_etape')->get();
        return view('admin.classement.c_etape', ['classements'=> $classement]);
    }

    public function classementEtape(Request $request)
    {
        $etapes = Etape::all();

        $selectedEtapeId = $request->input('etape', $etapes->first()?->id?? null);

        if ($selectedEtapeId) {
            $classements = DB::table('v_classement_etape')->where('id_etape', $selectedEtapeId)->get();
        } else {
            $classements = DB::table('v_classement_etape')->get();
        }

        return view('admin.classement.c_etape', [
            'classements' => $classements,
            'etapes' => $etapes,
            'selectedEtapeId' => $selectedEtapeId
        ]);
    }

    public function alea2($id)
    {
        $data = DB::table('v_alea2')->where('id_equipe',$id)->get();
        return view('admin.classement.alea2', ['datas' => $data]);
    }

    public function classementTotal()
    {
        $classement = DB::table('v_classement_total')->get();
        return view('admin.classement.c_total', ['classements'=> $classement]);
    }

    public function adminClassementCategorie(Request $request)
    {
        $categorie = Categorie::all();
        
        $selectedCategorieId = $request->input('id_categorie', $categorie->first()?->id?? null);


        if ($selectedCategorieId) {
            $classement = DB::select('
            select 
                id_categorie,
                login,
                DENSE_RANK() OVER (ORDER BY SUM(point) DESC) AS classement,
                sum(point) as point
            from v_classement_categorie
            where id_categorie = ?
            group by login,id_categorie
            ORDER by classement
            ', [$selectedCategorieId]);
            
        } else {
            $classement = DB::table('v_classement_total')->get();
        }

        return view('admin.classement.c_categorie', [
            'classements' => $classement,
            'categories' => $categorie,
            'selectedCategorieId' => $selectedCategorieId
        ]);
    }

    // -----------------------------------equipe----------------------------------------------------------------------------------------------------

    public function equipeClassementEtape2()
    {
        $classement = DB::table('v_classement_etape')->get();
        $etape = DB::table('v_classement_etape')
                    ->distinct()
                    ->pluck('id_etape');

        return view('equipe.classement.classement_etape', ['classements'=> $classement, 'etapes'=>$etape]);
    }

    public function equipeClassementEtape(Request $request)
    {
        $etapes = Etape::all();
        $selectedEtapeId = $request->input('etape', $etapes->first()?->id?? null);

        if ($selectedEtapeId) {
            $classements = DB::table('v_classement_etape')->where('id_etape', $selectedEtapeId)->get();
        } else {
            $classements = DB::table('v_classement_etape')->get();
        }

        return view('equipe.classement.classement_etape', [
            'classements' => $classements,
            'etapes' => $etapes,
            'selectedEtapeId' => $selectedEtapeId
        ]);
    }

    public function equipeClassementTotal()
    {
        $classement = DB::table('v_classement_total')->get();
        $winner = DB::select('select * from v_classement_total where point = (select max(point) from v_classement_total)');
        return view('equipe.classement.classement_total', ['classements'=> $classement, 'winner' => $winner]);
    }

    public function ClassementCategorie(Request $request)
    {
        $categorie = Categorie::all();
        $selectedCategorieId = $request->input('id_categorie', $categorie->first()?->id?? null);


        if ($selectedCategorieId) {
            $classement = DB::select('
            select 
                id_categorie,
                login,
                DENSE_RANK() OVER (ORDER BY SUM(point) DESC) AS classement,
                sum(point) as point
            from v_classement_categorie
            where id_categorie = ?
            group by login,id_categorie
            ORDER by classement
            ', [$selectedCategorieId]);

        } else {
            $classement = DB::table('v_classement_total')->get();
        }

        return view('equipe.classement.par_categorie', [
            'classements' => $classement,
            'categories' => $categorie,
            'selectedCategorieId' => $selectedCategorieId
        ]);
    }
}
