@extends('layouts.admin')

 
@section('content')

@php
                                

    $urls = '?emp_id='.intval(request()->get('emp_id')).'&camp_id='.intval(request()->get('camp_id')).'&date_from='.request()->get('date_from').'&date_to='.request()->get('date_to');


    $list_urls = '?emp_id='.intval(request()->get('emp_id')).'&camp_id='.intval(request()->get('camp_id')).'&date_from='.request()->get('date_from').'&date_to='.request()->get('date_to');
     $current_url = URL::current();
     $host = explode('/',$current_url);
     $emp_id = intval($host[5]);

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
      
                                <form id="1ajaxform">
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <div class="form-body">
                                        
                                        <div class="row p-t-20">
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Campaign Name</label>
                                                     <select class="form-control"  name="camp_id" id="camp_id">
                                                      <option value="">Select Campaign</option>
                                                            @foreach($campaigns as $campaigns)
                                                                 @if ($camp_id == $campaigns['id'])
                                                                    <option value="{{ $campaigns['id'] }}" selected>{{ $campaigns['source_name'] }}</option>
                                                                @else 
                                                                    <option value="{{ $campaigns['id'] }}">{{ $campaigns['source_name'] }}</option>
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
                                                     <button type="submit" id="sub_cmap" class="btn btn-success">Search</button>
                                                     {{-- <a type="button" href="{{ url('employees/'.request()->get('emp_id').'/performace').$list_urls}}" class="btn btn-success"> Search</a> --}}
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <br>
                                                     <a type="button" href="{{ route('getSingleViewLeads').$list_urls}}" class="btn btn-success addButton"> View in Tabular Format</a>
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
$( document ).ready(function() {
        const queryString = window.location.search;
        //alert(queryString);
        //console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const camp_id = urlParams.get('camp_id');
        //const emp_id = urlParams.get('emp_id');
        const emp_id = urlParams.get('emp_id');
        const date_from = urlParams.get('date_from');
        const date_to = urlParams.get('date_to');
        //console.log(employee_id);

        //var url = '{{ url("new") }}/'+employee_id;
       var url = '{{ url("new_emp_per") }}?emp_id='+emp_id+'&camp_id='+camp_id+'&date_from='+date_from+'&date_to='+date_to;
        console.log(url);
        $(document).on("click","#sub_cmap",function() {
                var  Current_url = '{{ url("/employees/'.$emp_id.'/performace") }}?emp_id='+emp_id+'&camp_id='+camp_id+'&date_from='+date_from+'&date_to='+date_to;
                ///alert(Current_url);
               // window.location = Current_url; // redirect
                window.location.href = Current_url;
                 return true;
        });
        

    $.get(url, function(data, status){
        console.log(data);
        console.log('data');
        
        $("#pending").text(data[0].value);
        $("#failed").text(data[1].value);
        $("#closed").text(data[2].value);
        
        var ctx3 = document.getElementById("chart3").getContext("2d");
        var data3 = data;
    
            var myPieChart = new Chart(ctx3).Pie(data3,{
                segmentShowStroke : true,
                segmentStrokeColor : "#fff",
                segmentStrokeWidth : 0,
                animationSteps : 100,
                tooltipCornerRadius: 0,
                animationEasing : "easeOutBounce",
                animateRotate : true,
                animateScale : false,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                responsive: true
            });
    });
});
</script>