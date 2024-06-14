<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function listeEtapeAdminTsotra()
    {
        $etape = DB::table('etapes')->get();
        return view('admin.liste.etapeAdmin', ['etapes' => $etape]);
    }

    public function resultat($id)
    {
        $resultat = DB::table('v_etape_coureur_chrono_penalite')->where('id_etape', $id)->get();
        return view('admin.liste.resultatAdmin', ['resultats' => $resultat]);

    }

    public function listeEtapeAdmin()
    {
        $etape = DB::table('etapes')->get();
        return view('admin.entrer.course', ['etapes' => $etape]);
    }

    public function etapeAdmin($id)
    {
        $course = DB::table('v_course')
                ->where('id_etape',$id)
                ->get();

        return view('admin.entrer.temps', ['courses' => $course]);
    }

    public function course(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'depart.*' => ['required', 'regex:/^(0[1-9]|[12]\d|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d\d (0[0-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/'],
            'arrive.*' => ['required', 'regex:/^(0[1-9]|[12]\d|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d\d (0[0-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/']
        ], [
            'depart.*.required' => 'Le champ de départ est requis.',
            'arrive.*.required' => 'Le champ d\'arrivée est requis.',
            'depart.*.regex' => 'Le champ de départ doit être au format dd/mm/yyyy hh:mm:ss.',
            'arrive.*.regex' => 'Le champ d\'arrivée doit être au format dd/mm/yyyy hh:mm:ss.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id_assignements = $request->input('id_assignement', []);
        $departs = $request->input('depart', []);
        $arrives = $request->input('arrive', []);

        foreach ($id_assignements as $index => $id_assignement) {
            Course::create([
                'id_assignement' => $id_assignement,
                'depart' => $departs[$index],
                'arrive' => $arrives[$index],
            ]);
        }

        return redirect()->route('listeEtapeAdmin')->with('success', 'Les temps ont été enregistrés avec succès.');
    }
}
