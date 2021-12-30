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
                        <li class="breadcrumb-item active">Add Note</li>
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
                                <h4 class="m-b-0 text-white">Add Note</h4>
                            </div>

                            <div class="card-body">
                               

                    
                            <form action="{{route('notes.store')}}" method="post">
                                @csrf
                                    <div class="form-body">
                                        
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label class="control-label">Lead Name</label>
                                                    <h6 class="card-subtitle">{{$data['first_name'].' '.$data['last_name']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                      <label class="control-label">Email</label>
                                                     <h6 class="card-subtitle">{{$data['email']}}</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                     <label class="control-label">Phone No</label>
                                                    <h6 class="card-subtitle">{{$data['phone_no']}}</h6>
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                      <label class="control-label">Source</label>
                                                     <h6 class="card-subtitle">{{$data['source']['source_name']}}</h6>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Date</label>
                                                    <h6 class="card-subtitle">{{$data['created_at']}}</h6>
                                                </div>
                                            </div>
                                        </div>


                                         <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Reminder Date</label>
                                                    <!--<input type="date" class="form-control" placeholder="Reminder Date" name="reminder_date" value="{{ old('reminder_date') }}">-->

                                                      <input type="text" class="form-control" placeholder="Reminder Date" name="reminder_date" value="{{ old('reminder_date') }}" id="min-date">

                                                    @if($errors->has('reminder_date'))
                                                        <div class="alert alert-danger">{{ $errors->first('reminder_date') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Reminder For</label>
                                                    <input type="text" class="form-control" placeholder="Reminder For" name="reminder_for" value="{{ old('reminder_for') }}">
                                                    @if($errors->has('reminder_for'))
                                                        <div class="alert alert-danger">{{ $errors->first('reminder_for') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row p-t-20">
                                          
                                   
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Note</label>
                                                    <input type="hidden" class="form-control" name="lead_id" placeholder="Lead Id" value="{{$data['id']}}">
                                                    <textarea type="text" class="form-control" name="note" placeholder="Enter Note" style="min-height: 130px;">{{ old('note') }}</textarea>
                                                    @if($errors->has('note'))
                                                        <div class="alert alert-danger">{{ $errors->first('note') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                     
                               
                                   
                                  <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                         <input type="reset" class="btn btn-inverse" value="Cancel" />
                                       <?php 
                                       if(!isset($_COOKIE['get_last_url'])) {
                                        $last_url = redirect()->getUrlGenerator()->previous();
                                    } else {
                                        $last_url =  $_COOKIE['get_last_url'];
                                    }
                                    ?>
                                            <a href="{{ $last_url }}"><button type="button" class="btn btn-info">Back</button></a>
                                    </div>

                                    </form>     


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

               
        </div>
  
@endsection

