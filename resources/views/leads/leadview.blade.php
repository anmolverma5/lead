@extends('layouts.admin')

 
@section('content')

@php 


if (isset($_GET["status"]))
{

if(isset($_GET['status']) && '1' == $_GET['status']) {
    
    $title = "Pending Leads";
}else if($_GET['status'] == 3){
    
    $title = "Closed Leads";
}else if($_GET['status'] == 2){
    
    $title = "Failed Leads";
} else{
    $title = "Leads";
}

}  else{
    $title = "Leads";
}





@endphp


<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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

                                <h4 class="m-b-0 text-white">{{ $title }}</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->

                                 <!-- <a type="button" href="{{ route('leads.create') }}" class="btn btn-success addButton"> + Add Lead</a> -->
                                 
                                    <form class="form-horizontal form-label-left input_mask" id="assignForm" method='post' action="{{ route('searchLead') }}">
                                            @csrf
                                            <div class="mian-dp">
                                                <div class="main-first">
                                                    <select  name="source_id" class="form-control custom-select" data-placeholder="Select Campaign" tabindex="1">
                                                        <option value="">Select Campaign</option>
                                                        @foreach($sources as $sources)
                                                            @if ($source_ids == $sources['id'])
                                                                <option value="{{ $sources['id'] }}" selected>{{ $sources['source_name'] }}</option>
                                                            @else
                                                                <option value="{{ $sources['id'] }}">{{ $sources['source_name'] }}</option>
                                                            @endif
                                                        @endforeach
                                                       
                                                    </select>
                                                    @if($errors->has('source_id'))
                                                        <div class="alert alert-danger">{{ $errors->first('source_id') }}</div>
                                                    @endif
                                                </div>
                                                <div class="main-second">
                                                    <button type="submit" id="submitButton" class="btn btn-success">Search</button>
                                                </div>
                                                
                                            </div>

                                        </form>


                               
                                <div class="table-responsive m-t-40">

                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Campaign</th>
                                                <th>Lead Name</th>
                                                <!--<th>Company Name</th>
                                                 <th>Job Title </th>-->
                                                 <th>Email</th>
                                                 <th>Phone No.</th>
                                        
                                                <th>Date</th>
                                    
                                                <th>Status</th>
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @php $i = 1; @endphp
                                            @foreach($data as $data)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <?php
                                                 if(!empty($data['source_id'])){
                                                  $campaign_id = $data['source_id'];
                                                  $source_data = App\Models\Source::where(['id'=>$data['source_id']])->first();
                                                  // echo"<pre>";print_r($source_data);echo"</pre>";
                                                  $campaign_name = $source_data->source_name;
                                                
                                                 }else{
                                                     $campaign_name = '';
                                                 }
                                                ?>
                                                <td class="wraping">{{ $campaign_name }}</td>
                                                <td class="wraping"><a href="{{ url('/leads', [$data['id']]) }}">{{ $data['first_name'].' '.$data['last_name'] }}</a></td>
                                                <!--<td class="wraping">{{ $data['company_name'] }}</td>
                                                <td>{{ $data['job_title'] }}</td>-->
                                                <td class="wraping">{{ $data['email'] }}</td>
                                                <td>{{ $data['phone_no'] }}</td>
                                   
                                                <td>{{ date('d M, Y', strtotime($data['created_at'])) }}</td>
                                

                                                @if($data['status'] == 1)
                                                    <td><span class="label label-warning">Pending</span></td>
                                                @elseif($data['status'] == 2)
                                                    <td><span class="label label-danger">Failed</span></td>
                                                @else
                                                    <td><span class="label label-success">Closed</span></td>
                                                @endif
                                                <td>
                                                   <a href="{{ url('/leads', [$data['id']]) }}"><span class="label label-success">View</span></a>   
                                                 </td>
                                                <!-- <td>
                                                    <a href="{{ url('/notes/view', [$data['id']]) }}">
                                                        <span  class="label label-warning">View All Notes</span>
                                                    </a>
                                                 <a href="{{ url('/leads', [$data['id']]) }}"><span class="label label-success">View</span></a>   

                                                <a href="{{ url('/leads/' . $data['id'] . '/edit') }}"><span class="label label-warning">Edit</span></a>
                                                
                                                <a href="{{ url('leads/delete', ['id' => $data['id']]) }}"  ><span class="label label-danger" onclick="return confirm('Are you sure you want to delete this lead ?')">Delete</span></a> 

                                                </td> -->
                      
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
{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
$(document).ready(function() {
    $('#pTable').DataTable();
});
</script> --}}