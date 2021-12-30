<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Source;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function analysis()
    {
        $record = Source::where(['user_id'=>auth()->user()->id])->with('total_leads')
        ->with('unassigned_leads')
        ->with('pending_leads')
        ->with('closed_leads')
        ->with('failed_leads')
        ->with('amount_invested')
        //->with('amount_genrated')
        ->with('amount_received')
        ->orderBy('id')
        ->get()->toArray();
        //dd($record);
        $data = [];
        foreach($record as $record){
          
            $total_amount = 0;
            foreach ($record['amount_invested'] as $item) {
                $total_amount += $item['amount'];
            }

            $amount_received = 0;
            foreach ($record['amount_received'] as $items) {
                foreach ($items['amount_received'] as $itemss) {
                    $amount_received += $itemss['amount'];
                }
            }

            //$data1['id']=$record['id'];
            $data1['source_name']=$record['source_name'];
            $data1['total_leads']= count($record['total_leads']);
            $data1['unassigned_leads']= count($record['unassigned_leads']);
            $data1['pending_leads']= count($record['pending_leads']);
            $data1['closed_leads']= count($record['closed_leads']);
            $data1['failed_leads']= count($record['failed_leads']);
            $data1['total_amount']=$total_amount;
            $data1['amount_genrated']=$total_amount;
            $data1['amount_received']=$amount_received;



             $data[] = $data1;

        }

        //dd($data);
         return view('performance')->with(['data'=>$data]);
        
    }


    public function performance()
    {
         return view('performance');
    }
    
    
     public function employees_performance()
    {
        
        /*$data = array(

            array(
                    'value'=> '2010',
                    'color'=> "#009efb",
                    'highlight'=> "#009efb",
                    'label'=> "Pending Leads"
        ), array(
                    'value'=> '2011',
                    'color'=> "#e30022",
                    'highlight'=>"#e30022",
                    'label'=> "Failed Leads",
        ),
         array(
                    'value'=> '2012',
                    'color'=> "#55ce63",
                    'highlight'=> "#55ce63",
                    'label'=> "Closed Leads",
        )
          
      );*/
      
          if(request()->get('employee_id')){
              $employee_id =  $_GET['employee_id']; 
          }else{
              $employee_id =  "";
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

         $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
         return view('employees_performance')->with(['employees'=>$employees,'employee_id'=>$employee_id,'date_from'=>$date_from,'date_to'=>$date_to]);
    }



    public function performanceMonthly()
    {
        /* $data = Lead::
        //->where('agent_id', $request->user()->id)
       //->whereIn('status_id', [3,4])
        //->whereYear('created_at', Carbon::now()->year)
        whereMonth('created_at', Carbon::now()->month-2)
        ->count();*/

        /*$data = Lead::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as month"))
        ->where("created_at",">", Carbon::now()->subMonths(2))
         ->whereYear('created_at', Carbon::now()->year)
         ->groupBy('month')
         ->get();

        $data= Lead::select('status', DB::raw('count(*) as count'), DB::raw("MONTHNAME(created_at) as month"))
                    ->where("created_at",">", Carbon::now()->subMonths(2))
                    ->whereYear('created_at', Carbon::now()->year)
                     ->groupBy(['month','status'])
                     ->get();*/
            $user_id = auth()->user()->id;
        $data = Lead::
        
         //selectRaw('count(*) as total')
        selectRaw(DB::raw("MONTHNAME(created_at) as month"))
        ->selectRaw("count(case when user_id = '$user_id' and status = '1' then 1 end) as pending")
        ->selectRaw("count(case when user_id = '$user_id' and status = '2' then 1 end) as failed")
        ->selectRaw("count(case when user_id = '$user_id' and status = '3' then 1 end) as closed")
        
        ->where("created_at",">", Carbon::now()->subMonths(6))
        //->whereYear('created_at', Carbon::now()->year)
        //->orderBy('month')
        ->orderByRaw('max(leads.created_at) asc')
         ->groupBy('month')
        ->get();

        return response()->json($data);

    }



    public function performanceYearly()
    {
        /* $data = Lead::
        //->where('agent_id', $request->user()->id)
       //->whereIn('status_id', [3,4])
        //->whereYear('created_at', Carbon::now()->year)
        whereMonth('created_at', Carbon::now()->month-2)
        ->count();*/

        /*$data = Lead::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as month"))
        ->where("created_at",">", Carbon::now()->subMonths(2))
         ->whereYear('created_at', Carbon::now()->year)
         ->groupBy('month')
         ->get();

        $data= Lead::select('status', DB::raw('count(*) as count'), DB::raw("MONTHNAME(created_at) as month"))
                    ->where("created_at",">", Carbon::now()->subMonths(2))
                    ->whereYear('created_at', Carbon::now()->year)
                     ->groupBy(['month','status'])
                     ->get();*/
                     
        $user_id = auth()->user()->id;
        
        $data = Lead::
         //selectRaw('count(*) as total')
        selectRaw(DB::raw("YEAR(created_at) as period"))
        //->selectRaw(DB::raw( DB::raw("CONVERT(period, CHAR)")))
       
        //CONVERT(b.id,CHAR)
        ->selectRaw("count(case when user_id = '$user_id' and status = '1' then 1 end) as pending")
        ->selectRaw("count(case when user_id = '$user_id' and status = '2' then 1 end) as failed")
        ->selectRaw("count(case when user_id = '$user_id' and status = '3' then 1 end) as closed")
        
        ->where("created_at",">", Carbon::now()->subYears(6))
        //->whereYear('created_at', Carbon::now()->year)
        //->orderBy('month')
        ->orderByRaw('max(leads.created_at) asc')
         ->groupBy('period')
        ->get();

        $data1 = array();
        foreach($data as $data){
            
            $data['period'] = (string) $data['period'];
            $data1[] =  $data;
        }

        //print_R($data);die;
       // $data['period'] = '2019';
        $data11 = array(

            array(
                    'period'=> '2010',
                    'pending'=> 1,
                    'failed'=> 0,
                    'closed'=> 0,
        ), array(
                    'period'=> '2011',
                    'pending'=> 0,
                    'failed'=> 0,
                    'closed'=> 0,
        ),
         array(
                    'period'=> '2012',
                    'pending'=> 0,
                    'failed'=> 0,
                    'closed'=> 0,
        ),
          array(
                    'period'=> '2013',
                    'pending'=> 0,
                    'failed'=> 0,
                    'closed'=> 0,
        )
      );
                    

        return response()->json($data1);

    }
    public function new(){

        $pending = new Lead;
        $failed = new Lead;
        $closed = new Lead;
    
        if(request()->get('employee_id')){
            $pending = $pending->where('asign_to', '=', $_GET['employee_id']);
            $failed = $failed->where('asign_to', '=', $_GET['employee_id']);
            $closed = $closed->where('asign_to', '=', $_GET['employee_id']);
         
        }
        //dd($pending);
       if(request()->get('date_from') && request()->get('date_to')){
          
            $from = date($_GET['date_from']);
            $to = date($_GET['date_to']);
 
            $pending = $pending->whereBetween('created_at', [$from, $to]);
            $failed = $failed->whereBetween('created_at', [$from, $to]);
            $closed = $closed->whereBetween('created_at', [$from, $to]);
         
        }
   
       // $pending = $pending->where(['user_id'=>auth()->user()->id,'status'=>'1'])->whereNotNull('asign_to')->count();
       // $failed =  $failed->where(['user_id'=>auth()->user()->id,'status'=>'2'])->whereNotNull('asign_to')->count();
       // $closed =  $closed->where(['user_id'=>auth()->user()->id,'status'=>'3'])->whereNotNull('asign_to')->count();
        
         $pending =  $pending->whereHas('users', function ($query) {
                    $query->where(['user_id'=>auth()->user()->id,'status'=>'1']);
         })->count();
         
         $failed =  $failed->whereHas('users', function ($query) {
                    $query->where(['user_id'=>auth()->user()->id,'status'=>'2']);
         })->count();
         
         
         $closed =  $closed->whereHas('users', function ($query) {
                    $query->where(['user_id'=>auth()->user()->id,'status'=>'3']);
         })->count();
        
     
        //dd(json_encode($closed));
     
        /*if (isset($_GET['employee_id'])) {
              $employee_id =  $_GET['employee_id'];
          }else{
              $employee_id =  "";
          }
        //dd($employee_id);
        
        if(empty($employee_id)){
            
            $pending = Lead::where(['user_id'=>auth()->user()->id,'status'=>'1'])->count();
            $failed = Lead::where(['user_id'=>auth()->user()->id,'status'=>'2'])->count();
            $closed = Lead::where(['user_id'=>auth()->user()->id,'status'=>'3'])->count();
            
           // $data['employee']->name = "Total Leads";
            
        }else{
            $pending = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$employee_id,'status'=>'1'])->count();
            $failed = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$employee_id,'status'=>'2'])->count();
            $closed = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$employee_id,'status'=>'3'])->count();
            
            //$data['employee'] = User::where(['id'=>$employee_id])->select('name')->first();
        }
      */
        
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
      
      //  $employees = User::where(['user_id'=>auth()->user()->id,'is_admin'=>'1'])->get()->toArray();
     //    return view('employees_performance')->with(['employees'=>$employees,'data'=>$data]);
         
        return response()->json($data);
    }
    
    public function employeesPerformance(){
        
        $pending = Lead::where(['user_id'=>auth()->user()->id,'status'=>'1'])->count();
        $failed = Lead::where(['user_id'=>auth()->user()->id,'status'=>'2'])->count();
        $closed = Lead::where(['user_id'=>auth()->user()->id,'status'=>'3'])->count();
        
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
    
    
     public function getEmployeesPerformance(Request $request)
    {
        if(empty($request->employee_id)){
            
            $pending = Lead::where(['user_id'=>auth()->user()->id,'status'=>'1'])->count();
            $failed = Lead::where(['user_id'=>auth()->user()->id,'status'=>'2'])->count();
            $closed = Lead::where(['user_id'=>auth()->user()->id,'status'=>'3'])->count();
            
           // $data['employee']->name = "Total Leads";
            
        }else{
            $pending = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$request->employee_id,'status'=>'1'])->count();
            $failed = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$request->employee_id,'status'=>'2'])->count();
            $closed = Lead::where(['user_id'=>auth()->user()->id,'asign_to'=>$request->employee_id,'status'=>'3'])->count();
            
            //$data['employee'] = User::where(['id'=>$request->employee_id])->select('name')->first();
        }
      
        
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



    public function allCounts(){

        if(auth()->user()->is_admin == 1){

            $totalLeads = Lead::count();
            $totalPendingLeads = Lead::where(['asign_to'=>auth()->user()->id, 'status'=>'1'])->count();
            $totalClosedLeads = Lead::where(['asign_to'=>auth()->user()->id, 'status'=>'3'])->count();
            $totalFailedLeads = Lead::where(['asign_to'=>auth()->user()->id, 'status'=>'2'])->count();

            $today = date('Y-m-d');
            
            $todayReminders = Note::where(['user_id'=>auth()->user()->id,'reminder_date'=>$today])->count(); 

           
           // return view('employeeDashboard')->with(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'todayReminders'=>$todayReminders]);

             return response()->json(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'todayReminders'=>$todayReminders]);


        }elseif(auth()->user()->is_admin == 2){


            $admins = User::where(['is_admin'=>null,'user_id'=>auth()->user()->id])->count();
            $employees = User::where(['is_admin'=>1,'user_id'=>auth()->user()->id])->count();
            $managers = User::where(['is_admin'=>2,'id'=>auth()->user()->id])->count();

            $totalLeads = Lead::where(['user_id'=>auth()->user()->id])->orWhere(['asign_to_manager'=>auth()->user()->id])->count();
            $totalPendingLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'1'])->orWhere(['asign_to_manager'=>auth()->user()->id])->count();
            $totalClosedLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'3'])->count();
            $totalFailedLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'2'])->count();


            $data = array (

                 'users' => array (
                    // array(
                    //     'label'=>"Admin",
                    //      'value'=> $admins,
                    // ),
                    array(
                        'label'=>"Manager",
                         'value'=>  $managers,
                    ),
                    array(
                        'label'=> "Employee",
                         'value'=>  $employees,
                    )
                ), 

                 'leads' => array (
                    array(
                        'label'=>"Total Leads",
                         'value'=> $totalLeads,
                    ),
                    array(
                        'label'=>"Pending",
                         'value'=> $totalPendingLeads,
                    ),
                    array(
                        'label'=> "Closed",
                         'value'=> $totalClosedLeads,
                    ),
                    array(
                        'label'=> "Failed",
                         'value'=> $totalFailedLeads,
                    )
                )
            );


             return response()->json($data);



            //return view('adminDashboard')->with(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'totalLeads'=>$totalLeads]);

             return response()->json(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'totalLeads'=>$totalLeads]);

        }else{

           /* $totalLeads = Lead::count();
            $totalPendingLeads = Lead::where(['status'=>'1'])->count();
            $totalClosedLeads = Lead::where(['status'=>'3'])->count();
            $totalFailedLeads = Lead::where(['status'=>'2'])->count();


            return view('adminDashboard')->with(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'totalLeads'=>$totalLeads]);*/

            
            $admins = User::where(['is_admin'=>null])->count();
            $employees = User::where(['is_admin'=>1])->count();
            $managers = User::where(['is_admin'=>2])->count();
             


            $totalLeads = Lead::count();
            $totalPendingLeads = Lead::where(['status'=>'1'])->count();
            $totalClosedLeads = Lead::where(['status'=>'3'])->count();
            $totalFailedLeads = Lead::where(['status'=>'2'])->count();


           // return view('adminDashboard')->with(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'totalLeads'=>$totalLeads]);

            $data = array (

                 'users' => array (
                    array(
                        'label'=>"Admin",
                         'value'=> $admins,
                    ),
                    array(
                        'label'=>"Manager",
                         'value'=>  $managers,
                    ),
                    array(
                        'label'=> "Employee",
                         'value'=>  $employees,
                    )
                ), 

                 'leads' => array (
                    array(
                        'label'=>"Total Leads",
                         'value'=> $totalLeads,
                    ),
                    array(
                        'label'=>"Pending",
                         'value'=> $totalPendingLeads,
                    ),
                    array(
                        'label'=> "Closed",
                         'value'=> $totalClosedLeads,
                    ),
                    array(
                        'label'=> "Failed",
                         'value'=> $totalFailedLeads,
                    )
                )
            );


             return response()->json($data);

        }

       
    }


    public function index()
    {

        //print_R(auth()->user());die;
        
            
        if(auth()->user()->is_admin == 1){

            $totalLeads = Lead::count();
            $totalPendingLeads = Lead::where(['asign_to'=>auth()->user()->id, 'status'=>'1'])->count();
            $totalClosedLeads = Lead::where(['asign_to'=>auth()->user()->id, 'status'=>'3'])->count();
            $totalFailedLeads = Lead::where(['asign_to'=>auth()->user()->id, 'status'=>'2'])->count();

            $today = date('Y-m-d');
            
            $todayReminders = Note::where(['user_id'=>auth()->user()->id,'reminder_date'=>$today])->count(); 

           
            return view('employeeDashboard')->with(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'todayReminders'=>$todayReminders]);


        }elseif(auth()->user()->is_admin == 2){

            $totalLeads = Lead::where(['user_id'=>auth()->user()->id])->orWhere(['asign_to_manager'=>auth()->user()->id])->count();
            $totalPendingLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'1'])->orWhere(['asign_to_manager'=>auth()->user()->id])->count();
            $totalClosedLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'3'])->count();
            $totalFailedLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'2'])->count();


            return view('adminDashboard')->with(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'totalLeads'=>$totalLeads]);

        }else{

            $totalLeads = Lead::count();
            $totalPendingLeads = Lead::where(['status'=>'1'])->count();
            $totalClosedLeads = Lead::where(['status'=>'3'])->count();
            $totalFailedLeads = Lead::where(['status'=>'2'])->count();


            return view('adminDashboard')->with(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'totalLeads'=>$totalLeads]);

            // $totalLeads = Lead::where(['user_id'=>auth()->user()->id])->count();
            // $totalPendingLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'1'])->count();
            // $totalClosedLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'3'])->count();
            // $totalFailedLeads = Lead::where(['user_id'=>auth()->user()->id, 'status'=>'2'])->count();


            // return view('adminDashboard')->with(['totalPendingLeads'=>$totalPendingLeads, 'totalClosedLeads'=>$totalClosedLeads, 'totalFailedLeads'=>$totalFailedLeads, 'totalLeads'=>$totalLeads]);

        }
    }
}
