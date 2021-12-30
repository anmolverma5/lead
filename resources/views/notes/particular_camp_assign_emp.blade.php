@extends('layouts.admin')

 
@section('content')

 <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pending Leads </li>
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
                                <h4 class="m-b-0 text-white">Pending Leads </h4>
                            </div>

                            <div class="card-body">
							
							
							 <!-- sample modal content -->
                                <div id="status-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form id="ajaxform">

                                             <meta name="csrf-token" content="{{ csrf_token() }}" />

                                             <div>
                                            <ul></ul>
                                        </div>

											<div class="modal-header">
                                                <h4 class="modal-title">Change Status</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                              <div class="alert alert-danger print-error-msg" style="display:none">
                                               <ul></ul>
                                                </div>
                                            <div class="modal-body">
                                                
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="control-label">Select Status: </label>
                                                        <select class="form-control" id="status" name="status" required>
														<option value="">Select Status</option>
														<option value="3">Closed</option>
														<option value="2">Failed</option>
														</select>
                                                        @if($errors->has('status'))
                                                        <div class="alert alert-danger">{{ $errors->first('status') }}</div>
                                                    @endif
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
											<input type="hidden" id="lead_id" name="lead_id">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <button id="save-data" type="button" class="btn btn-info waves-effect waves-light ">Save changes</button>
                                            </div>
                                        </div>
									</form>
                                    </div>
                                </div>
							
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->
                             
                                <div class="table-responsive m-t-40">

                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Campaign Name</th>
                                                <th>Lead Name</th>
                                                <!--<th>Company Name</th>
                                                <th>Job Title</th>-->
                                                <th>Email</th>
                                                <th>Phone No.</th>
                                                {{-- <th>Date</th> --}}
                                                <!--<th>Source</th>-->
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
                                                <td><a href="{{ url('/leads', [$data['id']]) }}">{{ $data['first_name'].' '.$data['last_name'] }}</a></td>
                                                <!--<td>{{ $data['company_name'] }}</td>
                                                <td>{{ $data['job_title'] }}</td>-->
                                                
                                                <td>{{ $data['email'] }}</td>
                                                <td>{{ $data['phone_no'] }}</td>
                                                {{-- <td>{{ date('d M, Y', strtotime($data['created_at'])) }}</td> --}}
             
                                                <td>
                                                    <a href="{{ url('/leads', [$data['id']]) }}"><span class="label label-success">View lead</span></a>   
                                                    <a href="{{ url('/leads/' . $data['id'] . '/edit') }}"><span class="label label-warning">Edit Lead</span></a>
                                                    <a href="{{ url('/notes/add', [$data['id']]) }}">
                                                        <span class="label label-primary">Add Notes</span>
                                                    </a>
                                                    
                                                    <a href="{{ url('/notes/view', [$data['id']]) }}">
                                                        <span  class="label label-warning">View All Notes</span>
                                                    </a>
                                                  
                                                    <span class="label label-info" onclick="document.getElementById('lead_id').value={{ $data['id'] }}" data-toggle="modal" data-target="#status-modal">Change Status</span>

                                                    
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
  
    <!--<script type = "text/javascript" src = "//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" ></script>-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  <script>
$( document ).ready(function() {
  
  $("#save-data").click(function(event){
      event.preventDefault();
     
      let status = $("select[name=status]").val(); 
      let lead_id = $("input[name=lead_id]").val(); 
      let _token   = $('meta[name="csrf-token"]').attr('content');


//alert(status+'--lead='+lead_id+'--token='+_token);

      $.ajax({
        url: '{{route("changeStatus")}}',
        type:"POST",
        data:{
          lead_id:lead_id,
          status:status,
          _token: _token
        },
        success:function(response){

            //console.log(response);

            if($.isEmptyObject(response.error)){
                console.log(response);
                toastr.success(response.success,'Success!')
                  if(response) {
                     $(".print-error-msg").css('display','none');
                    $('.success').text(response.success);
                    location.reload(true);
                    $("#ajaxform")[0].reset();
                  //}else{
                   // printErrorMsg(response.error);
                  }

            }else{
                //printErrorMsg(response.error);
                
                 //$('.error').text(response.error);
                  toastr.error(response.error,'Error!');
                  // location.reload(true);
               // toastr.error('errors messages');
            }

        },
       });


      function printErrorMsg (msg) {
        console.log(msg);
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            //$.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
           // });
        }


  });

});
</script>
  
  
@endsection

