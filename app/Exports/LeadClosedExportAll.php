<?php

namespace App\Exports;

use App\Models\Lead;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMapping;

class LeadClosedExportAll implements FromQuery, WithHeadings, WithEvents, ShouldAutoSize
{

    use Exportable;
    // public function prepareRows($rows)
    // {
    //     // $rows = Lead::where('status', 3)->get();
    //     return $rows->transform(function ($user) {
    //         $user->download_PDF = '';
    //         return $user;
    //     });
    // }
    public function query()
    {
        return Lead::query()
            ->orderBy('status', 'desc');
    }

    public function headings(): array
    {
        return [
            'id',
            'user_name',
            'company_name',
            'first_name',
            'last_name',
            'job_title',
            'employee_size',
            'web_address',
            'revenue_size',
            'industry',
            'physical_address',
            'city',
            'state',
            'zip_code',
            'country',
            'lead_name',
            'lead_details',
            'linkedin_address',
            'source_name',
            'email',
            'phone_no',
            'phone_no2',
            'asign_to',
            'asign_to_manager',
            'feedback',
            'status',
            'total_amount',
            'no_of_installment',
            'location',
            'timezone',
            'prospect_name',
            'designation',
            'designation_level',
            'bussiness_function',
            'date_shared',
            'created_at',
            'updated_at',
            'deleted_at',
            'download_PDF',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:AZ1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                ]);
            }
        ];
    }
}
