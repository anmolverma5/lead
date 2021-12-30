@extends('layouts.admin')

 
@section('content')

<style type="text/css">
    
    .icons {

     width: 40px;

    }
</style>

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Closed Lead List</li>
                    </ol>
                </div>
                <div>
                    <!--<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>--->
                </div>
            </div>

            
 <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">

                        @if (Session::has('success'))
                           <div class="alert alert-success" role="alert">
                               {{Session::get('success')}}
                           </div>
                        @elseif (Session::has('error'))
                           <div class="alert alert-danger" role="alert">
                               {{Session::get('error')}}
                           </div>
                        @endif
                        
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Closed Lead List</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
                             
                                <div class="table-responsive m-t-40">

                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>

                                                <th>Sr. No</th>
                                                <th>Lead Name</th>
                                                <!--<th>Company Name</th>
                                                <th>Job Title</th>-->
                                                <th>Email</th>
                                                <th>Phone No.</th>
                                                <th>Date</th>
                                                <!--<th>Source</th>
                                                <th>Feedback</th>--->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @php $i = 1; @endphp
                                            @foreach($data as $data)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <?php
                                                    $sources_data = App\Models\Source::where(['id'=>$data['source_id']])->first();
                                                    ?>
                                                    <td>{{ $sources_data->source_name }}</td>
                                                <td class="wraping"><a href="{{ url('/leads', [$data['id']]) }}">{{ $data['first_name'].' '.$data['last_name'] }}</a></td>
                                                <!--<td class="wraping">{{ $data['company_name'] }}</td>
                                                <td>{{ $data['job_title'] }}</td>-->
                                                <td class="wraping">{{ $data['email'] }}</td>
                                                <td>{{ $data['phone_no'] }}</td>
                                                <td>{{ date('d M, Y', strtotime($data['updated_at'])) }}</td>
                  
                                                <td>

                                                     <a href="{{ url('/feedbacks/add', [$data['id']]) }}">
                                                        <span class="label label-info">Add Feedback</span>  
                                                    </a>
                                                   
                                                    <a href="{{ url('/notes/view', [$data['id']]) }}">
                                                        <span class="label label-success">View All Notes</span>
                                                    </a>
                                                    <?php
                                                      $getlhs_report =  App\Models\LhsReport::where(['lead_id'=>$data['id']])->first();
                                                  
                                                    ?>
                                                    @if(!empty($getlhs_report))
                                                    <a href="{{ url('/employee/lhs_report/view_lhs', [$data['id']]) }}">
                                                        <span class="label label-success">View LHS Report</span>
                                                    </a>
                                                    <a href="{{ url('/employee/lhs_report/edit', [$data['id']]) }}">
                                                        <span class="label label-success">Edit LHS Report</span>
                                                    </a>
                                                    @else
                                                    <a href="{{ url('/employee/lhs_report', [$data['id']]) }}">
                                                        <span class="label label-success">Add LHS Report</span>
                                                    </a>
                                                    @endif

                                                </td>
                      
                                            </tr>
                                             @php $i = $i+1; @endphp
                                            @endforeach
                               
                              
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

               
        </div>
  
@endsection

