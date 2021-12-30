@extends('layouts.admin')

 
@section('content')

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('notes') }}">Notes</a></li>
                        <li class="breadcrumb-item active">View Note</li>
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
                                <h4 class="m-b-0 text-white">View Note</h4>
                            </div>


                            <div class="card-body">

                                   <!--<a type="button" href="{{ url('/notes/add', [$data['id']]) }}" class="btn btn-success addButton"> + Add Notes</a><br>
                                   <br>
                                   <br>-->

                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->

                    
                          
                                    <div class="form-body">
                                        
                                        <div class="row p-t-20">
                                           <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Campaign Name</label>
                                                    <?php
                                                    $sources_data = App\Models\Source::where(['id'=>$data['source_id']])->first();
                                                    ?>
                                                   <h6 class="card-subtitle">{{$sources_data->source_name}}</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Lead Name</label>
                                                   <h6 class="card-subtitle">{{$data['first_name'].' '.$data['last_name']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                   <h6 class="card-subtitle">{{$data['email']}}</h6>
                                                </div>
                                            </div>
                              

                      
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Phone No</label>
                                                   <h6 class="card-subtitle">{{$data['phone_no']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Source</label>
                                                    <h6 class="card-subtitle">{{$data['source']['source_name']}}</h6>
                                                </div>
                                            </div>
                                            @if(auth()->user()->is_admin == 1)
                                             <div class="col-md-2">
                                                <div class="form-group">
                  
                                                    <a type="button" href="{{ url('/notes/add', [$data['id']]) }}" class="btn btn-success addButton"> + Add Notes</a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                   
                      
                    
                          
                                <div class="table-responsive m-t-40">

                                	
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                       
                                                <!--<th>Date</th>-->
                                                <th>Lead Name</th>
                                                <th>Note</th>
                                                <th>Reminder Date</th>
                                                <th>Reminder For</th>
                                                 @if(auth()->user()->is_admin == 1)
                                                <th>Action</th>
                                                @endif
                                              
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['notes'] as $record)
                                            <tr>
                                                <!--<td>{{ $record['created_at'] }}</td>-->
                                                <td>{{ $record['lead']['first_name'].' '.$record['lead']['last_name'] }}</td>
                                                <td>{{ $record['feedback'] }}</td>
                                                <td>{{ date('d M, Y', strtotime( $record['reminder_date'])) }}</td>
                                                <td>{{ $record['reminder_for'] }}</td>
                                                @if(auth()->user()->is_admin == 1)
                                                <td><a href="{{ url('/notes/' . $record['id'] . '/edit') }}"><span class="label label-info">Edit</span></a></td>
                                                @endif
                                    
                                            </tr>
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

