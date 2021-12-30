@extends('layouts.admin')


@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Campaigns</li>
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
                    <h4 class="m-b-0 text-white">Campaigns</h4>

                </div>

                <div id="myModal" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add Lable</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form id="ajaxform">

                                    <meta name="csrf-token" content="{{ csrf_token() }}" />

                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Date</label>
                                        <div class="col-md-12">
                                            <input type="date" class="form-control" placeholder="Date" name="date">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Amount</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="Amount" name="amount">
                                        </div>
                                    </div>


                                    <input type="hidden" id="source_id" name="source_id">
                                    </from>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info waves-effect save-data"
                                    data-dismiss="modal">Save</button>
                                <button type="button" class="btn btn-default waves-effect"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="card-body">
                    <!--<h4 class="card-title">Data Export </h4>
                               <h6 class="card-subtitle">Copy, CSV, PDF & Print</h6>-->
                    <a type="button" href="{{ route('sources.create') }}" class="btn btn-success addButton"> + Add
                        Campaign</a>
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Campaign Id</th>
                                    <th>Campaign</th>
                                    <th>Total Leads</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Manager</th>
                                    <th>Created On </th>
                                    <th>Modified On </th>
                                    <!--<th>Total Amount</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($data as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['id']}}</td>
                                    <td>{{$data['source_name']}}</td>
                                    <?php
                                               $data_src = App\Models\Lead::where(['source_id'=>$data['id']])->select(DB::raw('COUNT(source_id) as totalLeads'))->groupBy('source_id')->first();
                                                ?>
                                    <td>{{$data_src->totalLeads}}</td>
                                    <td>{{$data['start_date']}}</td>
                                    <td>{{$data['end_date']}}</td>
                                    <?php
                                                $user_check = Auth::user()->is_admin;
                                                if(empty($user_check)){
                                                    if(!empty($data['assign_to_manager'])){
                                                        $assigned_manager = $data['assign_to_manager'];
                                                        $manager_data = App\Models\User::where(['id'=>$assigned_manager,'is_admin'=>'2'])->first();
                                                       //echo"<pre>";print_r($manager_data);echo"</pre>";
                                                        $manager_name = $manager_data->name;

                                                       }else{
                                                           $manager_name = 'N/A';
                                                       }
                                                }else{
                                                    $manager_name = 'N/A';
                                                }

                                               ?>
                                    <td>{{ $manager_name }}</td>
                                    <!--@if(!empty($data['amount']))
                                                <td>Rs.{{$data['amount']}}/--</td>
                                                @else
                                                <td>Rs.0/--</td>
                                                @endif-->

                                    <td>{{ date('d-m-Y', strtotime($data['created_at'])) }}</td>
                                    <td>{{date('d-m-Y', strtotime($data['updated_at']))}}</td>
                                    <td>

                                        @if(empty($user_check))
                                        <!--<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"><span class="label label-info" onclick="document.getElementById('source_id').value={{$data['id']}}">Add Money</span></a>--->
                                        @if(!empty($data['assign_to_manager']))
                                        <a href="javascript:void(0);"><span
                                                class="label label-warning">Assigned</span></a>
                                        @else
                                        <a href="{{ url('/sources/' . $data['id'] . '/camp_assign') }}"><span
                                                class="label label-warning">Assign to Manager</span></a>
                                        @endif
                                        @endif
                                        <a href="{{ url('/sources/' . $data['id'] . '/leadview') }}"><span
                                                class="label label-success">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View Leads</span></a>

                                        <a href="{{ url('/sources/' . $data['id'] . '/edit') }}"><span
                                                class="label label-warning">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</span></a>

                                        <a href="{{ url('sources/delete', ['id' => $data['id']]) }}"><span
                                                class="label label-danger"
                                                onclick="return confirm('Are you sure you want to delete this source ?')">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete</span></a>
                                        <a href="{{ url('/lead/exportCsv/' . $data['id']). '/report_down' }}"><span
                                                class="label label-warning">
                                                <i class="fa fa-file-excel-o" aria-hidden="true"> </i> Report</span></a>
                                        <a href="{{ url('/lead/export/' . $data['id']). '/pdf_down' }}"><span
                                                class="label label-warning"> <i class="ti-download"> </i> PDF</span>

                                        </a>

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

<script>
    $(".save-data").click(function(event){
      event.preventDefault();

      let date = $("input[name=date]").val();
      let samount = $("input[name=amount]").val();
      let source_id = $("input[name=source_id]").val();
      let _token   = $('meta[name="csrf-token"]').attr('content');


//alert(date+"**"+samount+"**"+source_id+"**"+_token);

      $.ajax({
        url: '{{route("updateAmount")}}',
        type:"POST",
        data:{
          source_id:source_id,
          date:date,
          amount:samount,
          _token: _token
        },
        success:function(response){

            console.log(response);

            if($.isEmptyObject(response.error)){
                toastr.success(response.success,'Success!')
                  if(response) {
                     $(".print-error-msg").css('display','none');
                    $('.success').text(response.success);

                    setTimeout(reloadPage, 1000);

                    $("#ajaxform")[0].reset();
                  }

            }else{
                printErrorMsg(response.error);
            }

        },
       });


      function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }


  });
</script>

@endsection
