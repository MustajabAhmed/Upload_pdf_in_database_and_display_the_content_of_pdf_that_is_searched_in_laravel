<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Smalot\PdfParser\Parser;

class FileController extends Controller
{
    public function index()
    {
        return view('file');
    }
    public function store(Request $request)
    {

        $file = $request->file;

        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);

        // use of pdf parser to read content from pdf 
        $fileName = $file->getClientOriginalName();
        // $file->move(public_path('pdf'), $fileName);
        $pdfParser = new Parser();
        $pdf = $pdfParser->parseFile($file->path());
        $content = $pdf->getText();
        $upload_file = new File;
        $upload_file->orig_filename = $fileName;
        $upload_file->mime_type = $file->getMimeType();
        $upload_file->filesize = $file->getSize();
        $upload_file->content = $content;
        $upload_file->save();
        return redirect('search')->with('success', 'File uploaded successfullly...');
    }

    public function search(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $file = File::where('content', 'LIKE', "%$search%")->get();
        }
        $text = strtolower($file);
        $find = strtolower($request->search);
        $pos = strpos($text, $find);
        if ($pos == true) {

            $message = "String was found";
            return view('data', compact('file'));
        } else {

            echo "String not found.";
        }
    }
}