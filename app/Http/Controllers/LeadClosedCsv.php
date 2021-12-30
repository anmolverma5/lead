<?php

namespace App\Http\Controllers;

use App\Exports\LeadClosedExport;
use App\Exports\LeadClosedExportAll;
use App\Models\Lead;
use App\Models\Source;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class LeadClosedCsv extends Controller
{
    public function export()
    {
        // Source::all();
        // $name =  Source::query()->where("id", '=', $id)->get();
        // foreach ($name as $data) {
        //     $data1 = [
        //         'source_name' => $data['source_name'],
        //     ];
        // }
        $storeExcel =  Excel::store(new LeadClosedExportAll, "public/Excel/" . 'leadclosed' . date("-d-m-Y") . '.xlsx');
        return Excel::download(new LeadClosedExportAll, ("leadclosed" . date("-d-m-Y") . ".xlsx"));
    }
    public function reportDown(Request $request, $id)
    {

        Source::all();
        $name =  Source::query()->where("id", '=', $id)->get();
        foreach ($name as $data) {
            $data1 = [
                'source_name' => $data['source_name'],
            ];
        }
        $source_name =  $data['source_name'];
        $storeExcel =  Excel::store(new LeadClosedExport($request->id), "public/Excel/" . $source_name . date("-d-m-Y") . '.xlsx');
        return Excel::download(new LeadClosedExport($request->id), ($source_name . date("-d-m-Y") . ".xlsx"));
    }
}
