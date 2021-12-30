@extends('layouts.admin')

 
@section('content')

@php
                                

    $urls = '?employee_id='.request()->get('employee_id').'&date_from='.request()->get('date_from').'&date_to='.request()->get('date_to');

@endphp

<style>
    .form-control {
      height: calc(0em + .0rem + 0px) !important; 
    }
    .btn {
        margin-top: 5px;
    }
</style>

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"> Employees Performance</li>
                    </ol>
                </div>
                <div>
                    <!--<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>--->
                </div>
            </div>



            <div class="container-fluid">

                <div class="row">
                    
                    <div class="col-12">
                       <div class="card card-outline-info">
                            
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Employee Performance</h4>
                            </div>
                            
                            <div class="card-body">
      
                                <form id="ajaxform">
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <div class="form-body">
                                        
                                        <div class="row p-t-20">
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Employee Name</label>
                                                     <select class="form-control"  name="employee_id" id="employee_id">
                                                      <option value="">Select Employee</option>
                                                            @foreach($employees as $employees)
                                                                @if ($employee_id == $employees['id'])
                                                                    <option value="{{ $employees['id'] }}" selected>{{ $employees['name'] }}</option>
                                                                @else
                                                                    <option value="{{ $employees['id'] }}">{{ $employees['name'] }}</option>
                                                                @endif
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Date From</label>
                                                        <input type="text" class="form-control" placeholder="Date From" name="date_from" value="{{ $date_from }}" id="date_from">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Date To</label>
                                                    <input type="text" class="form-control" placeholder="Date To" name="date_to" value="{{ $date_to }}" id="date_to">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <br>
                                                     <button type="submit" class="btn btn-success">Search</button>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <br>
                                                     <a type="button" href="{{ route('getViewLeads').$urls}}" class="btn btn-success addButton"> View in Tabular Format</a>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </form>
                            <div>
                                    
                
                                <h2 style="text-align:center" id="title"></h2>
                                
                                <br>

                                <canvas id="chart3" height="60"></canvas>
                                
                                <br><br>
                                    
                               <!-- <ul class="list-inline text-center m-t-40">
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #009efb"></i>Pending</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #e30022"></i>Failed</h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-circle m-r-5" style="color: #55ce63"></i>Closed</h5>
                                    </li>
                                </ul>-->
                                
                                 <ul class="list-inline text-center m-t-40">
                                    <li>
                                        <h5><i class="fa fa-square m-r-5" style="color: #009efb"></i>Pending Leads : <span id="pending"></span></h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-square m-r-5" style="color: #e30022"></i>Failed Leads : <span id="failed"></span></h5>
                                    </li>
                                    <li>
                                        <h5><i class="fa fa-square m-r-5" style="color: #55ce63"></i>Closed Leads : <span id="closed"></span></h5>
                                    </li>
                                </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
     
            </div>
            


  
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">

/*
  $(function(){

        $('#employee_id').change(function() {
            
            var employee_id = $(this).val();
            var url = '{{ url("employees_performance") }}?ids='+employee_id;
            window.location.href = url;
        });
        
  });*/

</script>