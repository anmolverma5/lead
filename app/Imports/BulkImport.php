<?php
namespace App\Imports;
use App\Bulk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Source;

class BulkImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //if ($row['company_name'] == 0) {
         //    $row['company_name'] ="";
         //}
        // if (is_numeric($row['source_id'])) {
            
        //     $row['source_id'] = $row['source_id'];
        
        // }else{
            
        //        $data = Source::where(['source_name'=>$row['source_id']])->select("id")->first();
               
        //        if($data){
                   
        //             $row['source_id'] = $data->id;
            
        //         }else{
             
        //             $data = array(
        //                 'user_id'=>auth()->user()->id,
        //                 'source_name'=>$row['source_id']
        //             );
            
        //              $source = Source::create($data);
                    
        //             $row['source_id'] = $source->id;
        //         }
        // }  
        $data = Source::select("id")->latest()->first();
        
        return new Bulk([

            'user_id'=> auth()->user()->id,
            'source_id'     => $data->id,
            'company_name' => $row['company_name'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'phone_no'=> $row['phone_no'],
            'location'=> $row['location'],
            'timezone'=> $row['timezone'],
            'industry'=> $row['industry'],
            'prospect_name'=> $row['prospect_name'],
            'designation'=> $row['designation'],
            'linkedin_address'=> $row['linkedin_address'],
            'bussiness_function'=> $row['bussiness_function'],
            'phone_no2'=> $row['phone_no2'],
            'designation_level'=> $row['designation_level'],
            'date_shared'=> date('Y-m-d', strtotime($row['date_shared'])),
             /*'job_title' => $row['job_title'],
             'web_address'=> $row['web_address'],
            'employee_size'=> $row['employee_size'],
            'revenue_size'=> $row['revenue_size'],
            'industry'=> $row['industry'],
            'physical_address'=> $row['physical_address'],
            'city'=> $row['city'],
            'state'=> $row['state'],
            'zip_code'=> $row['zip_code'],
            'country'=> $row['country'],
            'linkedin_address'=> $row['linkedin_address'],
            'lead_name'=> $row['job_title'],*/

        ]);
    }
}