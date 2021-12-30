<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\BulkExport;
use App\Imports\BulkImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Source;
use Validator;
use App\Http\Requests\ImportRequest;

class ImportExportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * 
    */
    public function importLeads()
    {
       return view('importexport');
    }
    public function import(ImportRequest $request) 
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'source_name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->passes()) {
            $data = array(
                'user_id'=>auth()->user()->id,
                'source_name'=>$request->source_name,
                'description'=>$request->description,
                'start_date'=>date('Y-m-d', strtotime($request->start_date)),
                'end_date'=>date('Y-m-d', strtotime($request->end_date))
            );
            Source::create($data);
           Excel::import(new BulkImport,request()->file('file'));
        }
           
        //return back()->with('success', 'Campaign Imported Successfully.');
        return redirect('sources')->with('success', 'Campaign Imported Successfully.');
    }
}

