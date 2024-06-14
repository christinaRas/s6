<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function pdf()
    {
        return view('equipe.pdf.pdf');
    }

    public function pdfAdmin()
    {
        $winner = DB::select('select * from v_classement_total where point = (select max(point) from v_classement_total)');
        return view('admin.pdf.pdfAdmin', ['winner' => $winner]);
    }

    public function generatePdfAdmin()
    {
        // Appeler la méthode rendue() pour obtenir la variable $winner
        $winner = $this->rendue();
    
        // Charger la vue et convertir en HTML avec la variable $winner
        $html = view('admin.pdf.rendue', ['winner' => $winner])->render();
    
        // Instancier Dompdf
        $pdf = new Dompdf();
    
        // Charger le HTML dans Dompdf
        $pdf->loadHtml($html);
    
        // Définir le format du papier et l'orientation
        $pdf->setPaper('A4', 'landscape');
    
        // Rendre le PDF
        $pdf->render();
    
        // Télécharger le PDF dans le navigateur
        return $pdf->stream('certificat.pdf');
    }
    
    public function rendue()
    {
        // Récupérer la variable $winner de la base de données
        $winner = DB::select('select * from v_classement_total where point = (select max(point) from v_classement_total)');
        
        // Retourner la vue avec la variable $winner
        return $winner;
    }

    public function generatePdf()
    {
        $html = view('equipe.pdf.rendueEquipe')->render();
        // Instancier Dompdf
        //installer sur cmd : composer require dompdf/dompdf
        $pdf = new Dompdf();

        // Charger le HTML dans Dompdf
        $pdf->loadHtml($html);

        // Définir le format du papier et l'orientation
        $pdf->setPaper('A4', 'landscape');

        // Rendre le PDF
        $pdf->render();

        // Télécharger le PDF dans le navigateur
        return $pdf->stream('certificat.pdf');
    }
}
