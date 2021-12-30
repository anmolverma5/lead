@extends('layouts.admin')

 
@section('content')

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Reminders</li>
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
                                <h4 class="m-b-0 text-white">Reminders</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->

                    
                          
                                <div class="table-responsive m-t-40">

                                	
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                       
                                                <!--<th>Date</th>-->
                                                <th>Lead Name</th>
                                                 <th>Job Title</th>
                                                <th>Note</th>
                                                <th>Reminder Date</th>
                                                <th>Reminder For</th>
                                                <th>Action</th>
                                              
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										@if($data)
                                            @foreach($data as $record)
                                            <tr>
                                                <!--<td>{{ $record['created_at'] }}</td>-->
                                                <td>{{ $record['lead']['first_name'].' '.$record['lead']['last_name'] }}</td>
                                                 <td>{{ $record['lead']['lead_name'] }}</td>
                                                <td>{{ $record['feedback'] }}</td>
                                                <td>{{ date('d M, Y', strtotime( $record['reminder_date'])) }}</td>
                                                <td>{{ $record['reminder_for'] }}</td>
                                                <td><a href="{{ url('/notes/' . $record['id'] . '/edit') }}"><span class="label label-info">Edit</span></a></td>

                      
                                            </tr>
                                            @endforeach
											@endif
                               
                              
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

               
        </div>
  
@endsection

