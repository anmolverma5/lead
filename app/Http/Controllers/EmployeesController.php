<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\LhsReport;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\ManagerEmployeeRequest;
use App\Http\Requests\EditEmployeeRequest;
use App\Http\Requests\EditManagerEmployeeRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Source;
use Illuminate\Support\Facades\URL;

class EmployeesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admin = User::where(['is_admin'=>Null,'id'=>auth()->user()->id])->first();
        if(!empty($admin)){
            $data = User::where(['is_admin'=>'1'])->get()->toArray();
        }else{
         //$data = User::where(['is_admin'=>'1','user_id'=>auth()->user()->id])->get()->toArray();
         $data = User::where(['is_admin'=>'1'])->get()->toArray();
        }
          return view('employees.list')->with(['data'=>$data]);
        
    }

    public function create()
    {
            $employeeCount = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->count();
            if(auth()->user()->is_admin != NULL){
                if($employeeCount >= 2){
                    return view('employees.add');
                   // return redirect('employees')->with('error', 'Please contact with admin to add more employees.');
                }else{
    
                    return view('employees.add');
                }
            }else{
                return view('employees.add');
            }
    }


    public function store(EmployeeRequest $request)
    {

        $password = rand(10000000,99999999);

         $data = array(
            'user_id'=>auth()->user()->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'name'=>$request->first_name.' '.$request->last_name,
            'phone_no'=>$request->phone_no,
            'email'=>$request->email,
            'password'=>Hash::make($password),
            'orignal_password'=>$password,
            'address'=>$request->address,
            'is_admin'=>'1',
        );

        User::create($data);
        
        return redirect('employees')->with('success', 'Employee Added Successfully.');
        
    }
    
    
    public function addManagerEmployee()
    {
        $managers = User::where(['is_admin'=>'2'])->select('id','name')->get()->toArray();
        return view('employees.addManagerEmployee')->with(['managers'=>$managers]);
    }
    
    
    public function storeManagerEmployee(ManagerEmployeeRequest $request)
    {

        $password = rand(10000000,99999999);

         $data = array(
            'user_id'=>$request->manager_id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'name'=>$request->first_name.' '.$request->last_name,
            'phone_no'=>$request->phone_no,
            'email'=>$request->email,
            'password'=>Hash::make($password),
            'orignal_password'=>$password,
            'address'=>$request->address,
            'is_admin'=>'1',
        );

        User::create($data);
        
        return redirect()->route('employees.show', ['id' => $request->manager_id])->with('success', 'Employee Added Successfully.');
        
    }
    
    
    public function editManagerEmployee($id)
    {
        $managers = User::where(['is_admin'=>'2'])->select('id','name')->get()->toArray();
        $data = User::where(['id'=>$id])->first();
        return view('employees.editManagerEmployee')->with(['data'=>$data,'managers'=>$managers]);
    }


    public function updateManagerEmployee(Request $request, $id)
    {
        
         $validator = Validator::make(
            $request->all(), [
                'first_name' => 'required|min:3|max:20',
                'last_name' => 'required|min:3|max:20',
               //'email' => 'required|email|unique:users',
               'email' => 'required|email|unique:users,email,'.$id,
                'phone_no' => 'required|min:10|numeric|unique:users,phone_no,'.$id,
                'address' => 'required|min:3|max:30',
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $input = $request->all(); 

        $data = User::find($id);
        
        $data->user_id = $input['manager_id'];
        $data->first_name = $input['first_name'];
        $data->last_name = $input['last_name'];
        $data->name = $input['first_name'].' '.$input['last_name'];
        $data->phone_no = $input['phone_no'];
        $data->email = $input['email'];
        $data->address = $input['address'];
    
        $data->save();

        //return redirect('employees')->with('success', 'Employee Updated Successfully.');
         return redirect()->route('employees.show', ['id' => $request->manager_id])->with('success', 'Employee Added Successfully.');
    }
    
    
    public function deleteManagerEmployee($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect()->back()->with('success', 'Employee Deleted Successfully.');
    }


    public function show($id)
    {
          $manager = User::where(['id'=>$id])->select('name')->first();
          $data = User::where(['is_admin'=>'1','user_id'=>$id])->get()->toArray();
          return view('employees.listManagerEmployee')->with(['data'=>$data,'manager'=>$manager]);
    }

    public function edit($id)
    {
       
        $data = User::where(['id'=>$id])->first();
        return view('employees.edit')->with(['data'=>$data]);
    }


    public function update(Request $request, $id)
    {
        //dd($request->email);
        $validator = Validator::make(
            $request->all(), [
                'first_name' => 'required|min:3|max:20',
                'last_name' => 'required|min:3|max:20',
               //'email' => 'required|email|unique:users',
               'email' => 'required|email|unique:users,email,'.$id,
                'phone_no' => 'required|min:10|numeric|unique:users,phone_no,'.$id,
                'address' => 'required|min:3|max:30',
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $input = $request->all(); 

        $data = User::find($id);
        
        $data->first_name = $input['first_name'];
        $data->last_name = $input['last_name'];
        $data->name = $input['first_name'].' '.$input['last_name'];
        $data->phone_no = $input['phone_no'];
        $data->email = $input['email'];
        $data->address = $input['address'];
    
        $data->save();

        return redirect('employees')->with('success', 'Employee Updated Successfully.');
    }


    public function destroy($id)
    {
        //
    }
    
    public function statusUpdate($id)
    {
       
        $manager = User::findOrFail($id);
        //dd($manager->first_name);
        //$manager->first_name = "DEMO";
        
        if($manager->is_active == 1){
            $manager->is_active = 2;
        }
        else
        {
            $manager->is_active = 1;
        }
        
        $manager->save();
        
        
        return redirect('employees')->with('success', 'Status Changed');
        
    }

    public function delete($id)
    {
        //dd('ddd');
        //Lead::where(['asign_to'=>$id,'status'=>'1'])->update(['asign_to'=>NULL]);
        $employee = User::findOrFail($id);
        $employee->delete();
        return redirect('employees')->with('success', 'Employee Deleted Successfully.');
    }

    public function lhs_report($id)
    {
        $get_lead = Lead::where(['id'=>$id])->first();
        return view('employees.export_Lhs')->with(['data'=>$get_lead]);
    }


    public function lhs_report_save(Request $request){

      //  dd($request);
        $data = array(
            'lead_id'=>$request->lead_id,
            'board_no'=>$request->board_no,
            'direct_no'=>$request->direct_no,
            'employees_strength'=>$request->employees_strength,
            'revenue'=>$request->revenue,
            'address'=>$request->address,
            'website'=>$request->website,
            'prospect_vertical'=>$request->prospect_vertical,
            'prospects_level'=>$request->prospects_level,
            'opt_in_status'=>$request->opt_in_status,
            'company_desc'=>$request->company_desc,
            'responsibilities'=>$request->responsibilities,
            'team_size'=>$request->team_size,
            'pain_areas'=>$request->pain_areas,
            'interest_new_initiatives'=>$request->interest_new_initiatives,
            'budget'=>$request->budget,
            'defined_agenda'=>$request->defined_agenda,
            'call_notes'=>$request->call_notes,
            'meeting_date1'=>date('Y-m-d', strtotime($request['meeting_date1'])),
            'meeting_date2'=>date('Y-m-d', strtotime($request['meeting_date2'])),
            'ext_if_any'=>$request->ext_if_any,
            'ea_name'=>$request->ea_name,
            'ea_email'=>$request->ea_email,
            'ea_phone_no'=>$request->ea_phone_no,
            'meeting_teleconference'=>$request->meeting_teleconference,
            'contact_decision_maker'=>$request->contact_decision_maker,
            'influencers_decision_making_process'=>$request->influencers_decision_making_process,
            'company_already_affiliated '=>$request->company_already_affiliated,
        );

        LhsReport::create($data);
        return redirect('leads/closed')->with('success', 'LHS Report Added Successfully.');

    }
    public function edit_lhs_report($id){

        $get_lead_report = LhsReport::where(['lead_id'=>$id])->first();
        $get_lead = Lead::where(['id'=>$id])->first();
        return view('employees.edit_export_Lhs')->with(['data'=>$get_lead_report,'lead_info'=> $get_lead]);
    }
    public function update_lhs_report(Request $request){
         
        $input = $request->all(); 
        $data = LhsReport::find($request->lead_lhs_id);
        $data->lead_id = $input['lead_id'];
        $data->board_no = $input['board_no'];
        $data->direct_no = $input['direct_no'];
        $data->employees_strength = $input['employees_strength'];
        $data->revenue = $input['revenue'];
        $data->address = $input['address'];
        $data->website = $input['website'];
        $data->prospect_vertical = $input['prospect_vertical'];
        $data->prospects_level = $input['prospects_level'];
        $data->opt_in_status = $input['opt_in_status'];
        $data->company_desc = $input['company_desc'];
        $data->responsibilities = $input['responsibilities'];
        $data->team_size = $input['team_size'];
        $data->pain_areas = $input['pain_areas'];
        $data->interest_new_initiatives = $input['interest_new_initiatives'];
        $data->budget = $input['budget'];
        $data->defined_agenda = $input['defined_agenda'];
        $data->call_notes = $input['call_notes'];
        $data->meeting_date1 = date('Y-m-d', strtotime($input['meeting_date1']));
        $data->meeting_date2 = date('Y-m-d', strtotime($input['meeting_date2']));
        $data->ext_if_any = $input['ext_if_any'];
        $data->ea_name = $input['ea_name'];
        $data->ea_email = $input['ea_email'];
        $data->ea_phone_no = $input['ea_phone_no'];
        $data->meeting_teleconference = $input['meeting_teleconference'];
        $data->contact_decision_maker = $input['contact_decision_maker'];
        $data->influencers_decision_making_process = $input['influencers_decision_making_process'];
        $data->company_already_affiliated = $input['company_already_affiliated'];
        $data->save();
        return Redirect::back()->with('success', 'LHS Report Updated Successfully.');
    }

    public function view_lhs($id){

        $get_lead_report = LhsReport::where(['lead_id'=>$id])->first();
        $get_lead = Lead::where(['id'=>$id])->first();
        return view('employees.view_lhs_report')->with(['data'=>$get_lead_report,'lead_info'=> $get_lead]);
    }


    public function performace($id){
        if(request()->get('camp_id')){
            $camp_id =  $_GET['camp_id']; 
        }else{
            $camp_id =  "";
        }
        
        if(request()->get('emp_id')){
            $emp_id =  $_GET['emp_id']; 
            }else{
                $emp_id =  "";
            }

        if(request()->get('date_from')){
            $date_from =  $_GET['date_from']; 
        }else{
            $date_from =  "";
        }
        
        
        if(request()->get('date_to')){
            $date_to =  $_GET['date_to']; 
        }else{
            $date_to =  "";
        }

       $campaigns = Source::get()->toArray();
       return view('employees.single_emp_performace')->with(['campaigns'=>$campaigns,'camp_id'=>$camp_id,'emp_id'=>$emp_id ,'date_from'=>$date_from,'date_to'=>$date_to]);
       

    }
    public function single_emp_views()
    {
          if(request()->get('camp_id')){
              $camp_id =  $_GET['camp_id']; 
          }else{
              $camp_id =  "";
          }
          if(request()->get('emp_id')){
            $emp_id =  $_GET['emp_id']; 
            }else{
                $emp_id =  "";
            }
          
          if(request()->get('date_from')){
              $date_from =  $_GET['date_from']; 
          }else{
              $date_from =  "";
          }
          
          
          if(request()->get('date_to')){
              $date_to =  $_GET['date_to']; 
          }else{
              $date_to =  "";
          }
          
        
        $data = new Lead;
    
        if(request()->get('camp_id') && request()->get('emp_id')){
            $data = $data->where('source_id', '=', $_GET['camp_id'])->where('asign_to', '=', $_GET['emp_id']);

        }
        if(request()->get('date_from') && request()->get('date_to')){
          
            $from = date($_GET['date_from']);
            $to = date($_GET['date_to']);

            $data = $data->whereBetween('created_at', [$from, $to]);
         
        }
        $data =  $data->whereHas('users', function ($query) {
                    $query->where(['user_id'=>auth()->user()->id]);
          })->with('source')->get()->toArray();

        $campaigns = Source::get()->toArray();
         return view('employees.single_emp_view')->with(['campaigns'=>$campaigns,'data'=>$data,'camp_id'=>$camp_id,'date_from'=>$date_from,'date_to'=>$date_to]);
    }
    public function new_emp_per(){
        
        $pending = new Lead;
        $failed = new Lead;
        $closed = new Lead;
        if(request()->get('camp_id') && request()->get('emp_id')){
           // dd();
            $pending = $pending->where('source_id', '=', $_GET('camp_id'))->where('asign_to', '=', $_GET('emp_id'));
            $failed = $failed->where('source_id', '=', $_GET['camp_id'])->where('asign_to', '=', $_GET('emp_id'));
            $closed = $closed->where('source_id', '=', $_GET['camp_id'])->where('asign_to', '=', $_GET('emp_id'));
        }
        
       if(request()->get('date_from') && request()->get('date_to')){
            $from = date($_GET['date_from']);
            $to = date($_GET['date_to']);
            $pending = $pending->whereBetween('created_at', [$from, $to]);
            $failed = $failed->whereBetween('created_at', [$from, $to]);
            $closed = $closed->whereBetween('created_at', [$from, $to]);
         
        }

         $pending =  $pending->whereHas('users', function ($query) {
                    $query->where(['user_id'=>auth()->user()->id,'status'=>'1']);
         })->count();
         $failed =  $failed->whereHas('users', function ($query) {
                    $query->where(['user_id'=>auth()->user()->id,'status'=>'2']);
         })->count();
         
         
         $closed =  $closed->whereHas('users', function ($query) {
                    $query->where(['user_id'=>auth()->user()->id,'status'=>'3']);
         })->count();
        

        $data = array(

            array(
                    'value'=> $pending,
                    'color'=> "#009efb",
                    'highlight'=> "#009efb",
                    'label'=> "Pending Leads"
            ), array(
                    'value'=> $failed,
                    'color'=> "#e30022",
                    'highlight'=>"#e30022",
                    'label'=> "Failed Leads",
            ),
            array(
                    'value'=> $closed,
                    'color'=> "#55ce63",
                    'highlight'=> "#55ce63",
                    'label'=> "Closed Leads",
            )
          
      );
      
        return response()->json($data);
    }

}
