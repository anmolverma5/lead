<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Bulk extends Model
{
    protected $table = 'leads';
    protected $fillable = [
        //'user_id','source_id', 'lead_name','lead_details', 'email','phone_no',
        
        'user_id',
        'source_id',
        'company_name',
        'first_name',
        'last_name',
        'job_title',
        'email',
        'phone_no',
        'web_address',
        'employee_size',
        'revenue_size',
        'industry',
        'physical_address',
        'city',
        'state',
        'zip_code',
        'country',
        'linkedin_address',
        'lead_name',
        'location',
        'timezone',
        'prospect_name',
        'designation',
        'bussiness_function',
        'phone_no2',
        'designation_level',
        'date_shared',

    ];
}

