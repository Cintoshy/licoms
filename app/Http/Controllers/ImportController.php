<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Book;

class ImportController extends Controller
{
    public function showImportForm()
    {   
        return view('faculty/import/import');
    }
    public function indexxx()
    {   
        $book = Book::all();
        return view('admin/index', compact('book'));
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls|max:2048',
            ]);
    
            $file = $request->file('file');
            
            Excel::import(new UsersImport(), $file);
            
            return back()->with('import', 'Excel data imported successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Handle validation errors
            // You can get the validation errors from $e->failures() and provide a response to the user
            // For example:
            return back()->withErrors($e->failures())->withInput();
        } catch (\Maatwebsite\Excel\Reader\ImportHandlerException $e) {
            // Handle import handler errors
            // You can provide a response to the user based on the specific error message
            // For example:
            return back()->with('error', 'Error during import: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other unexpected exceptions
            // You can log the error and provide a general error message to the user
            // For example:
            \Log::error($e);
            return back()->with('error', 'An unexpected error occurred during import.');
        }
    }
    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls|max:2048',
    //     ]);

    //     $file = $request->file('file');
        
    //     Excel::import(new UsersImport(), $file);
        
    //     return back()->with('import', 'Excel data imported successfully.');
    // }
}
