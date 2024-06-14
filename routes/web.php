<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClassementController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EtapeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PenaliteController;
use App\Http\Controllers\ResetTablesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('admin.layout.dashboard');
})->name('dashboard');
Route::get('/reset-tables', [ResetTablesController::class, 'reset'])->name('reset-tables');

//auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/inscri', [AuthController::class, 'inscri'])->name('inscri');
Route::post('/loginpost', [AuthController::class, 'loginPost'])->name('loginpost');
Route::post('/inscripost', [AuthController::class, 'inscriPost'])->name('inscripost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


//admin-----------------------------------------------------------------------------------------------------------------------------------------------
//j4
Route::get('/listeEtapeAdminTsotra', [CourseController::class, 'listeEtapeAdminTsotra'])->name('listeEtapeAdminTsotra');
Route::get('/resultat/{id}', [CourseController::class, 'resultat'])->name('resultat');


//assigner le temps pour chaque coureur
Route::get('/listeEtapeAdmin', [CourseController::class, 'listeEtapeAdmin'])->name('listeEtapeAdmin');
Route::get('/etapeAdmin/{id}', [CourseController::class, 'etapeAdmin'])->name('etapeAdmin');
Route::post('/course', [CourseController::class, 'course'])->name('course');

//classement
// Route::get('/classementEtape', [ClassementController::class, 'classementEtape2'])->name('classementEtape');
Route::get('/classementEtape', [ClassementController::class, 'classementEtape'])->name('classementEtape');
Route::post('/classementEtape', [ClassementController::class, 'classementEtape']);
Route::get('/classementTotal', [ClassementController::class, 'classementTotal'])->name('classementTotal');
    //categorie
Route::get('/adminClassementCategorie', [ClassementController::class, 'adminClassementCategorie'])->name('adminClassementCategorie');
Route::post('/adminClassementCategorie', [ClassementController::class, 'adminClassementCategorie']);

Route::get('/alea/{id}', [ClassementController::class, 'alea2'])->name('alea');


//import
Route::get('/importEtape', [ImportController::class, 'etape'])->name('importEtape');
Route::post('/importEtapePost', [ImportController::class, 'postEtape'])->name('importEtapePost');
Route::get('/importPoint', [ImportController::class, 'point'])->name('importPoint');
Route::post('/importPointPost', [ImportController::class, 'postPoint'])->name('importPointPost');

//genrer categorie
Route::get('/generateCategorie', [CategorieController::class, 'categorie'])->name('generateCategorie');

//penalite
Route::get('/penalite', [PenaliteController::class, 'index'])->name('penalite');
Route::get('/ajoutPenalite', [PenaliteController::class, 'ajoutPenalite'])->name('ajoutPenalite');
Route::post('/traitementPenalite', [PenaliteController::class, 'traitementPenalite'])->name('traitementPenalite');
Route::delete('/deletePenalite/{id_penalite}', [PenaliteController::class, 'delete'])->name('delete.penalite');

//pdf
Route::get('/pdfAdmin', [PdfController::class, 'pdfAdmin'])->name('pdfAdmin');
Route::get('/generate-pdfAdmin', [PdfController::class, 'generatePdfAdmin']);
Route::get('/rendue', [PdfController::class, 'rendue']);





//equipe-----------------------------------------------------------------------------------------------------------------------------------------------
//assigner le coureur pour chaque etapes
Route::get('/listeEtape', [EtapeController::class, 'store'])->name('listeEtape');
Route::post('/etape/{id}', [EtapeController::class, 'etape'])->name('etape');
Route::post('/attribution', [EtapeController::class, 'attribution'])->name('attribution');


//classement
// Route::get('/equipeClassementEtape', [ClassementController::class, 'equipeClassementEtape2'])->name('equipeClassementEtape');
Route::get('/equipeClassementEtape', [ClassementController::class, 'equipeClassementEtape'])->name('equipeClassementEtape');
Route::post('/equipeClassementEtape', [ClassementController::class, 'equipeClassementEtape']);
Route::get('/equipeClassementTotal', [ClassementController::class, 'equipeClassementTotal'])->name('equipeClassementTotal');
    //categorie
Route::get('/ClassementCategorie', [ClassementController::class, 'ClassementCategorie'])->name('ClassementCategorie');
Route::post('/ClassementCategorie', [ClassementController::class, 'ClassementCategorie']);

//pdf equipe
Route::get('/pdf', [PdfController::class, 'pdf'])->name('pdf');
Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);