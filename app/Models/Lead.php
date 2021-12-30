<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'user_id',
        'source_id',
        'company_name',
        'first_name',
        'last_name',
        'location',
        'timezone',
        'industry',
        'prospect_name',
        'designation',
        'linkedin_address',
        'bussiness_function',
        'email',
        'phone_no',
        'phone_no2',
        'designation_level',
        'date_shared',
        /*'job_title',
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
        'lead_name',*/

    ];

    public function source()
    {
        return $this->belongsTo('App\Models\Source');
    }
    public function lhsreport()
    {
        return $this->hasOne('App\Models\LhsReport', 'lead_id', 'id');
    }

    public function installments()
    {
        return $this->hasMany('App\Models\Installment');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }

    public function note()
    {
        return $this->hasOne('App\Models\Note');
    }

    public function feedback()
    {
        return $this->hasOne('App\Models\Feedback');
    }

    public function amount_received()
    {
        return $this->hasMany('App\Models\Installment')->where(['status' => 2]);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'asign_to')->withTrashed();
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'asign_to');
    }
}
