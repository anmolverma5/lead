<?php

namespace App\Http\Controllers;

use App\Exports\LeadClosedExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Lead;
use App\Models\LhsReport;
use App\Models\Source;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class LeadClosedController extends Controller
{
    public function generatePDF()
    {
        $datas = Lead::where('status', 3)->with('lhsreport')->get();
        foreach ($datas as $data) {
            $data1 = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'company_name' => $data['company_name'],
                'industry' => $data['industry'],
                'designation' => $data['designation'],
                'linkedin_address' => $data['linkedin_address'],
                'email' => $data['email'],
                'phone_no' => $data['phone_no'],
                'board_no' => $data['lhsreport']['board_no'],
                'direct_no' => $data['lhsreport']['direct_no'],
                'ext_if_any' => $data['lhsreport']['ext_if_any'],
                'employees_strength' => $data['lhsreport']['employees_strength'],
                'revenue' => $data['lhsreport']['revenue'],
                'ea_name' => $data['lhsreport']['ea_name'],
                'address' => $data['lhsreport']['address'],
                'ea_phone_no' => $data['lhsreport']['ea_phone_no'],
                'ea_email' => $data['lhsreport']['ea_email'],
                'prospects_level' => $data['lhsreport']['prospects_level'],
                'website' => $data['lhsreport']['website'],
                'prospect_vertical' => $data['lhsreport']['prospect_vertical'],
                'opt_in_status' => $data['lhsreport']['opt_in_status'],
                'company_desc' => $data['lhsreport']['company_desc'],
                'responsibilities' => $data['lhsreport']['responsibilities'],
                'team_size' => $data['lhsreport']['team_size'],
                'defined_agenda' => $data['lhsreport']['defined_agenda'],
                'call_notes' => $data['lhsreport']['call_notes'],
                'meeting_teleconference' => $data['lhsreport']['meeting_teleconference'],
                'contact_decision_maker' => $data['lhsreport']['contact_decision_maker'],
                'influencers_decision_making_process' => $data['lhsreport']['influencers_decision_making_process'],
                'company_already_affiliated' => $data['lhsreport']['company_already_affiliated'],
                'meeting_date1' => $data['lhsreport']['meeting_date1'],
                'meeting_date2' => $data['lhsreport']['meeting_date2'],
                'created_at' => $data['lhsreport']['created_at'],
                'updated_at' => $data['lhsreport']['updated_at'],
                'pain_areas' => $data['lhsreport']['pain_areas'],
                'interest_new_initiatives' => $data['lhsreport']['interest_new_initiatives'],
                'budget' => $data['lhsreport']['budget'],
                'designation_level' => $data['designation_level'],
            ];
            $firstname = $data['first_name'];
            $lastname = $data['last_name'];
            $pdf = PDF::loadView('leadClosed', $data1);
            Storage::put("public/" . "Excel"  . "/pdf/"  . $firstname . $lastname  . date("-d-m-Y") . ".pdf", $pdf->output());
        }
        /*       Zip Downloader           */
        Storage::disk('local')->makeDirectory('tobedownload', $mode = 0775); // zip store here
        $zip_file = storage_path('app/tobedownload/' . 'leadClosed' . date("-d-m-Y") . '.zip');
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = storage_path("app/public/Excel/pdf/"); // path to your pdf files
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file) {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                // extracting filename with substr/strlen
                $relativePath = substr($filePath, strlen($path) + 0);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        $headers = array('Content-Type' => 'application/octet-stream',);
        $zip_new_name = "leadClosed" . date("-d-m-Y") . ".zip";
        return response()->download($zip_file, $zip_new_name, $headers);
        return redirect('leads/export_excel_pdf');
    }
    public function generateSinglePDF($id)
    {
        /*            Lead data get       */
        $datas = Lead::where('status', '=', 3)
            ->where("source_id", '=', $id)
            ->with('lhsreport')
            ->get();
        // dd($datas);
        /*       Source name get         */
        Source::all();
        $name =  Source::query()->where("id", '=', $id)->get();
        foreach ($name as $data) {
            $data1 = [
                'source_name' => $data['source_name'],

            ];
        }
        $source_name =  $data['source_name'];
        // $getid = 121;
        // LhsReport::all();
        // $getalldata = LhsReport::where('lead_id', '=', $getid)->get();
        // foreach ($getalldata as $data) {
        //     $data1 = [
        //         'direct_no' => $data['direct_no'],
        //     ];
        // }
        // dd($data);
        /*       PDF Data Get         */
        foreach ($datas as $data) {
            $data1 = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'company_name' => $data['company_name'],
                'industry' => $data['industry'],
                'designation' => $data['designation'],
                'linkedin_address' => $data['linkedin_address'],
                'email' => $data['email'],
                'phone_no' => $data['phone_no'],
                'board_no' => $data['lhsreport']['board_no'],
                'direct_no' => $data['lhsreport']['direct_no'],
                'ext_if_any' => $data['lhsreport']['ext_if_any'],
                'employees_strength' => $data['lhsreport']['employees_strength'],
                'revenue' => $data['lhsreport']['revenue'],
                'ea_name' => $data['lhsreport']['ea_name'],
                'address' => $data['lhsreport']['address'],
                'ea_phone_no' => $data['lhsreport']['ea_phone_no'],
                'ea_email' => $data['lhsreport']['ea_email'],
                'prospects_level' => $data['lhsreport']['prospects_level'],
                'website' => $data['lhsreport']['website'],
                'prospect_vertical' => $data['lhsreport']['prospect_vertical'],
                'opt_in_status' => $data['lhsreport']['opt_in_status'],
                'company_desc' => $data['lhsreport']['company_desc'],
                'responsibilities' => $data['lhsreport']['responsibilities'],
                'team_size' => $data['lhsreport']['team_size'],
                'defined_agenda' => $data['lhsreport']['defined_agenda'],
                'call_notes' => $data['lhsreport']['call_notes'],
                'meeting_teleconference' => $data['lhsreport']['meeting_teleconference'],
                'contact_decision_maker' => $data['lhsreport']['contact_decision_maker'],
                'influencers_decision_making_process' => $data['lhsreport']['influencers_decision_making_process'],
                'company_already_affiliated' => $data['lhsreport']['company_already_affiliated'],
                'meeting_date1' => $data['lhsreport']['meeting_date1'],
                'meeting_date2' => $data['lhsreport']['meeting_date2'],
                'created_at' => $data['lhsreport']['created_at'],
                'updated_at' => $data['lhsreport']['updated_at'],
                'pain_areas' => $data['lhsreport']['pain_areas'],
                'interest_new_initiatives' => $data['lhsreport']['interest_new_initiatives'],
                'budget' => $data['lhsreport']['budget'],
                'designation_level' => $data['designation_level'],
            ];
            // dd($data['lhsreport']['board_no']);
            // dd($data);
            // $getid = $data['id'];
            /*       Second database data get         */
            // LhsReport::all();
            // $getalldata = LhsReport::where('lead_id', '=', $getid)->get();
            // foreach ($datas as $data) {
            //     $data1 = [
            //         'phone_no' =>  $data['lhsreport']['board_no'],
            //     ];
            // dd($data22);
            /*       PDF Store         */
            // dd($data['lhsreport']['board_no']);
            // foreach ($datas['lhsreport'] as $data) {
            $pdf = PDF::loadView('leadClosed', $data1);
            $firstname = $data['first_name'];
            $lastname = $data['last_name'];
            $kasa = Storage::put("public/Excel/"  . $source_name . "/"  . $firstname . $lastname  . date("-d-m-Y") . ".pdf", $pdf->output());
            // }
            // dd($kasa);
        }
        if ($data['status'] == 3) {
            /*       Zip Downloader           */
            Storage::disk('local')->makeDirectory('tobedownload', $mode = 0775); // zip store here
            $zip_file = storage_path('app/tobedownload/' . $source_name . date("-d-m-Y") . '.zip');
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
            $path = storage_path("app/public/Excel/" . $source_name . "/"); // path to your pdf files
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($files as $name => $file) {
                // We're skipping all subfolders
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    // extracting filename with substr/strlen
                    $relativePath = substr($filePath, strlen($path) + 0);
                    $zip->addFile($filePath, $relativePath);
                }
            }
        } else {
            echo '<script>alert("pdf not found"); </script>';
            return Redirect::back()->with('error', "PDF Not Found");
        }

        $zip->close();
        $headers = array('Content-Type' => 'application/octet-stream',);
        $zip_new_name = $source_name . date("-d-m-Y") . ".zip";
        return response()->download($zip_file, $zip_new_name, $headers);
        return redirect('leads/export_excel_pdf');
    }
    public function export_excel_pdf()
    {
        return view('exportExcelPdf');
    }
    public function viewpdf()
    {
        return view('leadClosed');
    }
}
