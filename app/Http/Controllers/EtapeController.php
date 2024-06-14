<?php

namespace App\Http\Controllers;

use App\Models\Assignement;
use App\Models\Etape;
use App\Models\Runner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class EtapeController extends Controller
{
    public function store()
    {
        $user=Auth::user()->id;
        $etape = DB::table('etapes')->get();
        $runner_chrono = DB::table('v_runner_chrono_penalite')
                            ->where('id_equipe',$user)
                            ->get();

        return view('equipe.etape.etape', ['etapes' => $etape, 'runner_chronos' => $runner_chrono]);
    }

    public function etape($id)
    {
        $equipe=Auth::user()->id;
        $runner = DB::table('runners')
                    ->where('id_user', $equipe)
                    ->get();

        $etape = DB::table('etapes')
                    ->where('id', $id)
                    ->first();

        return view('equipe.etape.assignement', ['etape' => $etape, 'runners' => $runner]);
    }

    public function attribution(Request $request)
    {
        $user=Auth::user()->id;

        $id_etape = $request->id_etape;
        $id_runner = $request->id_runner;

        $coureurs_assignes = Assignement::join('runners', 'assignements.id_runner', '=', 'runners.id')
        ->join('users', 'runners.id_user', '=', 'users.id')
        ->where('id_etape', $id_etape)
        ->where('id_user', $user)
        ->count();


        $max_coureur = Etape::findOrFail($id_etape)->nb_coureur;

        if ($coureurs_assignes < $max_coureur) {
            Assignement::create([
                'id_etape' => $id_etape,
                'id_runner' => $id_runner,
            ]);
            
            return redirect()->route('listeEtape')->with('success', 'Coureur attribué avec succès à l\'étape.');
        } else {
            return redirect()->route('listeEtape')->with('error', 'Le nombre maximal de coureurs pour cette étape a été atteint.');
        }
    }
}
