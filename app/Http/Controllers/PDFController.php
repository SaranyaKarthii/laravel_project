<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use Dompdf\Dompdf;
use PDF;
class PDFController extends Controller
{
    
public function index()
{
    //show how the page is
    $projects = Project::all();
    return view('PDF.index', compact('projects'));

}
    public function pdfView()
    {
        $projects = Project::all();

        $pdf = PDF::loadView('PDF.pdf_view', array('projects' => $projects))
        ->setPaper('a4', 'landscape');
        return $pdf->stream();       
        
        

    }
    public function pdfGeneration()
    {
        set_time_limit(300);
        $projects = Project::all();

        $pdf = PDF::loadView('PDF.pdf_convert', compact('projects'))
        ->setPaper('a4', 'landscape');
        return $pdf->download('myPDF.pdf');

    }




}
