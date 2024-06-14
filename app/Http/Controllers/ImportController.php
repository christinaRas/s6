<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Exists;

class ImportController extends Controller
{
    public function etape()
    {
        return view('admin.import.etapeImport');
    }

    public function point()
    {
        return view('admin.import.pointImport');
    }


    //tsotra
    // public function postEtape(Request $request)
    // {
    //     Schema::create('e', function (Blueprint $table) {
    //         $table->string('etape');
    //         $table->float('longueur');
    //         $table->integer('nb_coureur');
    //         $table->integer('rang');
    //         $table->string('date_depart');
    //         $table->string('heure_depart');
    //     });

    //     if ($request->hasFile('csv_file_etape')) {
    //         $path = $request->file('csv_file_etape')->getRealPath();

    //         if (($handle = fopen($path, 'r')) !== false) {
    //             fgetcsv($handle);

    //             while (($data = fgetcsv($handle)) !== false) {
    //                 DB::table('e')->insert([
    //                     'etape' => $data[0],
    //                     'longueur' => (float)str_replace(',', '.', $data[1]),
    //                     'nb_coureur' => (int)$data[2],
    //                     'rang' => (int)$data[3],
    //                     'date_depart' => Carbon::createFromFormat('d/m/Y', $data[4])->format('Y-m-d'),
    //                     'heure_depart' => $data[5],
    //                 ]);
    //             }
    //             fclose($handle);
    //         }
    //     }

    //     Schema::create('re', function (Blueprint $table) {
    //         $table->integer('rang_etape');
    //         $table->integer('numero_dossard');
    //         $table->string('nom');
    //         $table->string('genre');
    //         $table->date('date_naissance');
    //         $table->string('equipe');
    //         $table->timestamp('arrive');
    //     });

    //     if ($request->hasFile('csv_file_resultat')) {
    //         $path = $request->file('csv_file_resultat')->getRealPath();

    //         if (($handle = fopen($path, 'r')) !== false) {
    //             fgetcsv($handle);

    //             while (($data = fgetcsv($handle)) !== false) {
    //                 DB::table('re')->insert([
    //                     'rang_etape' => (int)$data[0],
    //                     'numero_dossard' => (int)$data[1],
    //                     'nom' => $data[2],
    //                     'genre' => $data[3],
    //                     'date_naissance' => Carbon::createFromFormat('d/m/Y', $data[4])->format('Y-m-d'),
    //                     'equipe' => $data[5],
    //                     'arrive' => Carbon::createFromFormat('d/m/Y H:i:s', $data[6])->format('Y-m-d H:i:s'),
    //                 ]);
    //             }
    //             fclose($handle);
    //         }
    //     }

    //     $etapes = DB::table('e')
    //         ->select('etape', 'longueur', 'nb_coureur', 'rang')
    //         ->distinct()
    //         ->get();

    //     foreach ($etapes as $etape) {
    //         $exist = DB::table('etapes')
    //             ->where('nom_etape', $etape->etape)
    //             ->where('rang', $etape->rang)
    //             ->first();

    //         if (!$exist) {
    //             DB::table('etapes')->insert([
    //                 'nom_etape' => $etape->etape,
    //                 'km' => $etape->longueur,
    //                 'nb_coureur' => $etape->nb_coureur,
    //                 'rang' => $etape->rang,
    //             ]);
    //         }
    //     }

    //     $users = DB::table('re')
    //         ->select('equipe')
    //         ->distinct()
    //         ->get();

    //     foreach ($users as $user) {
    //         $exist = DB::table('users')
    //             ->where('login', $user->equipe)
    //             ->first();

    //         if (!$exist) {
    //             DB::table('users')->insert([
    //                 'name' => $user->equipe,
    //                 'login' => $user->equipe,
    //                 'password' => bcrypt($user->equipe),
    //                 'role' => 'equipe',
    //             ]);
    //         }
    //     }

    //     $runners = DB::table('re')
    //         ->select('numero_dossard', 'nom', 'genre', 'date_naissance', 'equipe')
    //         ->distinct()
    //         ->get();

    //     foreach ($runners as $runner) {
    //         $equipe = DB::table('users')
    //             ->where('login', $runner->equipe)
    //             ->value('id');

    //         $exist = DB::table('runners')
    //             ->where('id_user', $equipe)
    //             ->where('nom_runner', $runner->nom)
    //             ->where('dossard', $runner->numero_dossard)
    //             ->where('genre', $runner->genre)
    //             ->first();

    //         if (!$exist) {
    //             DB::table('runners')->insert([
    //                 'id_user' => $equipe,
    //                 'nom_runner' => $runner->nom,
    //                 'dossard' => $runner->numero_dossard,
    //                 'genre' => $runner->genre,
    //                 'dtn' => $runner->date_naissance,
    //             ]);
    //         }
    //     }

    //     $assignements = DB::table('re')->get();

    //     foreach ($assignements as $assignement) {
    //         $etape = DB::table('etapes')
    //             ->where('rang', $assignement->rang_etape)
    //             ->value('id');

    //         $runner = DB::table('runners')
    //             ->where('nom_runner', $assignement->nom)
    //             ->where('dossard', $assignement->numero_dossard)
    //             ->where('genre', $assignement->genre)
    //             ->value('id');

    //         $exist = DB::table('assignements')
    //             ->where('id_etape', $etape)
    //             ->where('id_runner', $runner)
    //             ->first();

    //         if (!$exist) {
    //             DB::table('assignements')->insert([
    //                 'id_etape' => $etape,
    //                 'id_runner' => $runner,
    //             ]);
    //         }
    //     }

    //     $courses = DB::table('assignements')->get();

    //     foreach ($courses as $course) {
    //         $etape = DB::table('etapes')
    //             ->where('id', $course->id_etape)
    //             ->first();

    //         $e = DB::table('e')
    //             ->where('rang', $etape->rang)
    //             ->first();

    //         $runner = DB::table('runners')
    //             ->where('id', $course->id_runner)
    //             ->first();

    //         $re = DB::table('re')
    //             ->where('nom', $runner->nom_runner)
    //             ->where('numero_dossard', $runner->dossard)
    //             ->where('rang_etape',$etape->rang)
    //             ->first();

    //         if ($e && $re) {
    //             $depart = Carbon::createFromFormat('Y-m-d H:i:s', $e->date_depart . ' ' . $e->heure_depart)->format('Y-m-d H:i:s');
    //             $exist = DB::table('courses')
    //                 ->where('id_assignement', $course->id)
    //                 ->where('depart', $depart)
    //                 ->where('arrive', $re->arrive)
    //                 ->first();

    //             if (!$exist) {
    //                 DB::table('courses')->insert([
    //                     'id_assignement' => $course->id,
    //                     'depart' => $depart,
    //                     'arrive' => $re->arrive,
    //                 ]);
    //             }
    //         }
    //     }

    //     return redirect()->route('importEtape');
    // }


    // public function postPoint(Request $request)
    // {
    //     Schema::create('p', function (Blueprint $table) {
    //         $table->integer('classement');
    //         $table->integer('point');
    //     });

    //     if ($request->hasFile('csv_file_point')) {
    //         $path = $request->file('csv_file_point')->getRealPath();

    //         if (($handle = fopen($path, 'r')) !== false) {
    //             fgetcsv($handle);

    //             while (($data = fgetcsv($handle)) !== false) {
    //                 DB::table('p')->insert([
    //                     'classement' => (int)$data[0],
    //                     'point' => (int)$data[1],
    //                 ]);
    //             }
    //             fclose($handle);
    //         }
    //     }

    //     $points = DB::table('p')->get();
    //     foreach ($points as $point) {

    //         $exist = DB::table('points')
    //             ->where('classement', $point->classement)
    //             ->where('point', $point->point)
    //             ->first();

    //         if (!$exist) {
    //             DB::table('points')->insert([
    //                 'classement' => $point->classement,
    //                 'point' => $point->point,
    //             ]);
    //         }
    //     }

    //     Schema::dropIfExists('e');
    //     Schema::dropIfExists('re');
    //     Schema::dropIfExists('p');
    //     return redirect()->route('importPoint');
    // }



    //tonga dia tsisy miditra
    public function postEtape(Request $request)
    {
        DB::beginTransaction();

        try {
            Schema::create('e', function (Blueprint $table) {
                $table->string('etape');
                $table->float('longueur');
                $table->integer('nb_coureur');
                $table->integer('rang');
                $table->string('date_depart');
                $table->string('heure_depart');
            });
    
            if ($request->hasFile('csv_file_etape')) {
                $path = $request->file('csv_file_etape')->getRealPath();
    
                if (($handle = fopen($path, 'r'))!== false) {
                    fgetcsv($handle); // Ignore the header row
    
                    while (($data = fgetcsv($handle))!== false) {
                        DB::transaction(function () use ($data) {
                            DB::table('e')->insert([
                                'etape' => $data[0],
                                'longueur' => (float)str_replace(',', '.', $data[1]),
                                'nb_coureur' => (int)$data[2],
                                'rang' => (int)$data[3],
                                'date_depart' => Carbon::createFromFormat('d/m/Y', $data[4])->format('Y-m-d'),
                                'heure_depart' => $data[5],
                            ]);
                        }, 5); // The second parameter is the timeout in seconds
                    }
                    fclose($handle);
                }
            }
    
            Schema::create('re', function (Blueprint $table) {
                $table->integer('rang_etape');
                $table->integer('numero_dossard');
                $table->string('nom');
                $table->string('genre');
                $table->date('date_naissance');
                $table->string('equipe');
                $table->timestamp('arrive');
            });
    
            if ($request->hasFile('csv_file_resultat')) {
                $path = $request->file('csv_file_resultat')->getRealPath();
    
                if (($handle = fopen($path, 'r'))!== false) {
                    fgetcsv($handle); // Ignore the header row
    
                    while (($data = fgetcsv($handle))!== false) {
                        DB::transaction(function () use ($data) {
                            DB::table('re')->insert([
                                'rang_etape' => (int)$data[0],
                                'numero_dossard' => (int)$data[1],
                                'nom' => $data[2],
                                'genre' => $data[3],
                                'date_naissance' => Carbon::createFromFormat('d/m/Y', $data[4])->format('Y-m-d'),
                                'equipe' => $data[5],
                                'arrive' => Carbon::createFromFormat('d/m/Y H:i:s', $data[6])->format('Y-m-d H:i:s'),
                            ]);
                        }, 5); // The second parameter is the timeout in seconds
                    }
                    fclose($handle);
                }
            }
    
            $etapes = DB::table('e')
                ->select('etape', 'longueur', 'nb_coureur', 'rang')
                ->distinct()
                ->get();
    
            foreach ($etapes as $etape) {
                $exist = DB::table('etapes')
                    ->where('nom_etape', $etape->etape)
                    ->where('rang', $etape->rang)
                    ->first();
    
                if (!$exist) {
                    DB::table('etapes')->insert([
                        'nom_etape' => $etape->etape,
                        'km' => $etape->longueur,
                        'nb_coureur' => $etape->nb_coureur,
                        'rang' => $etape->rang,
                    ]);
                }
            }
    
            $users = DB::table('re')
                ->select('equipe')
                ->distinct()
                ->get();
    
            foreach ($users as $user) {
                $exist = DB::table('users')
                    ->where('login', $user->equipe)
                    ->first();
    
                if (!$exist) {
                    DB::table('users')->insert([
                        'name' => $user->equipe,
                        'login' => $user->equipe,
                        'password' => bcrypt($user->equipe),
                        'role' => 'equipe',
                    ]);
                }
            }
    
            $runners = DB::table('re')
                ->select('numero_dossard', 'nom', 'genre', 'date_naissance', 'equipe')
                ->distinct()
                ->get();
    
            foreach ($runners as $runner) {
                $equipe = DB::table('users')
                    ->where('login', $runner->equipe)
                    ->value('id');
    
                $exist = DB::table('runners')
                    ->where('id_user', $equipe)
                    ->where('nom_runner', $runner->nom)
                    ->where('dossard', $runner->numero_dossard)
                    ->where('genre', $runner->genre)
                    ->first();
    
                if (!$exist) {
                    DB::table('runners')->insert([
                        'id_user' => $equipe,
                        'nom_runner' => $runner->nom,
                        'dossard' => $runner->numero_dossard,
                        'genre' => $runner->genre,
                        'dtn' => $runner->date_naissance,
                    ]);
                }
            }
    
            $assignements = DB::table('re')->get();
    
            foreach ($assignements as $assignement) {
                $etape = DB::table('etapes')
                    ->where('rang', $assignement->rang_etape)
                    ->value('id');
    
                $runner = DB::table('runners')
                    ->where('nom_runner', $assignement->nom)
                    ->where('dossard', $assignement->numero_dossard)
                    ->where('genre', $assignement->genre)
                    ->value('id');
    
                $exist = DB::table('assignements')
                    ->where('id_etape', $etape)
                    ->where('id_runner', $runner)
                    ->first();
    
                if (!$exist) {
                    DB::table('assignements')->insert([
                        'id_etape' => $etape,
                        'id_runner' => $runner,
                    ]);
                }
            }
    
            $courses = DB::table('assignements')->get();
    
            foreach ($courses as $course) {
                $etape = DB::table('etapes')
                    ->where('id', $course->id_etape)
                    ->first();
    
                $e = DB::table('e')
                    ->where('rang', $etape->rang)
                    ->first();
    
                $runner = DB::table('runners')
                    ->where('id', $course->id_runner)
                    ->first();
    
                $re = DB::table('re')
                    ->where('nom', $runner->nom_runner)
                    ->where('numero_dossard', $runner->dossard)
                    ->where('rang_etape',$etape->rang)
                    ->first();
    
                if ($e && $re) {
                    $depart = Carbon::createFromFormat('Y-m-d H:i:s', $e->date_depart . ' ' . $e->heure_depart)->format('Y-m-d H:i:s');
                    $exist = DB::table('courses')
                        ->where('id_assignement', $course->id)
                        ->where('depart', $depart)
                        ->where('arrive', $re->arrive)
                        ->first();
    
                    if (!$exist) {
                        DB::table('courses')->insert([
                            'id_assignement' => $course->id,
                            'depart' => $depart,
                            'arrive' => $re->arrive,
                        ]);
                    }
                }
            }

           
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => 'Une erreur est survenue lors de l\'importation des données. Veuillez réessayer.']);
        }

        return redirect()->route('importEtape');
    }

    public function postPoint(Request $request)
    {
        DB::beginTransaction();
        try {
            Schema::create('p', function (Blueprint $table) {
                $table->integer('classement');
                $table->integer('point');
            });

            if ($request->hasFile('csv_file_point')) {
                $path = $request->file('csv_file_point')->getRealPath();

                if (($handle = fopen($path, 'r'))!== false) {
                    fgetcsv($handle); // Skip header row if present

                    DB::transaction(function () use ($handle) {
                        while (($data = fgetcsv($handle))!== false) {
                            // Vérifie si la ligne a exactement deux éléments et si ces éléments sont numériques
                            if (count($data)!= 2 ||!is_numeric($data[0]) ||!is_numeric($data[1])) {
                                throw new \Exception("Ligne invalide trouvée : {$data[0]}, {$data[1]}");
                            }
                            DB::table('p')->insert([
                                'classement' => (int)$data[0],
                                'point' => (int)$data[1],
                            ]);
                        }
                    }, 300); // Définissez un délai d'attente approprié ici
                    fclose($handle);
                }
            }

            $points = DB::table('p')->get();
            foreach ($points as $point) {
                $exist = DB::table('points')
                    ->where('classement', $point->classement)
                    ->where('point', $point->point)
                    ->first();

                if (!$exist) {
                    DB::table('points')->insert([
                        'classement' => $point->classement,
                        'point' => $point->point,
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => 'Une erreur est survenue lors de l\'importation des données. Veuillez réessayer.']);
        }

        Schema::dropIfExists('e');
        Schema::dropIfExists('re');
        Schema::dropIfExists('p');
        return redirect()->route('importPoint');
    }




    //midtra fona
    // public function postPoint(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         Schema::create('p', function (Blueprint $table) {
    //             $table->integer('classement');
    //             $table->integer('point');
    //         });

    //         if ($request->hasFile('csv_file_point')) {
    //             $path = $request->file('csv_file_point')->getRealPath();

    //             if (($handle = fopen($path, 'r'))!== false) {
    //                 // Skip header row if present
    //                 fgetcsv($handle);

    //                 while (($data = fgetcsv($handle))!== false) {
    //                     // Check if the line has exactly two elements (ignoring empty lines)
    //                     if (count($data) == 2 && is_numeric($data[0]) && is_numeric($data[1])) {
    //                         DB::table('p')->insert([
    //                             'classement' => (int)$data[0],
    //                             'point' => (int)$data[1],
    //                         ]);
    //                     } else {
                            
    //                     }
    //                 }
    //                 fclose($handle);
    //             }
    //         }

    //         $points = DB::table('p')->get();
    //         foreach ($points as $point) {
    //             $exist = DB::table('points')
    //                 ->where('classement', $point->classement)
    //                 ->where('point', $point->point)
    //                 ->first();

    //             if (!$exist) {
    //                 DB::table('points')->insert([
    //                     'classement' => $point->classement,
    //                     'point' => $point->point,
    //                 ]);
    //             }
    //         }

    //         DB::commit();
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with(['error' => 'Une erreur est survenue lors de l\'importation des données. Veuillez réessayer.']);
    //     }

    //     Schema::dropIfExists('e');
    //     Schema::dropIfExists('re');
    //     Schema::dropIfExists('p');
    //     return redirect()->route('importPoint');
    // }
}
