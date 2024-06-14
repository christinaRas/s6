<?php

namespace App\Http\Controllers;

use App\Models\Penalite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenaliteController extends Controller
{
    public function index()
    {
        $penalite = DB::table('v_penalite')->get();
        return view('admin.penalite.listePenalite', ['penalites' => $penalite]);
    }

    public function ajoutPenalite()
    {
        $etape = DB::table('etapes')->get();
        $equipe = DB::table('users')->where('role', 'equipe')->get();
        return view('admin.penalite.ajoutPenalite', ['etapes' => $etape, 'equipes' => $equipe]);
    }

    public function traitementPenalite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penalite' => ['required', 'regex:/^([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/']
        ], [
            'penalite.required' => 'Le champ penalite est obligatoire.',
            'penalite.regex' => 'Le champ penalite doit être au format hh:mm:ss.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id_etape = $request->id_etape;
        $id_equipe = $request->id_equipe;
        $penalite = $request->penalite;

        try {
            Penalite::create([
                'id_etape' => $id_etape,
                'id_equipe' => $id_equipe,
                'penalite' => $penalite,
            ]);
            
            return redirect()->route('penalite')->with('success', 'Insertion penalite reussie');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'insertion : ' . $th->getMessage());
        }
    }

    public function delete($id_penalite)
    {
        $penalite = Penalite::find($id_penalite);
        if ($penalite) {
            $penalite->delete();
            return redirect()->route('penalite')->with('success', 'supprimé avec succès');
        }
        return redirect()->route('penalite')->with('error', 'non trouver');
    }
}
