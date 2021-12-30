@extends('layouts.admin')

 
@section('content')

<style type="text/css">
    .control-label {
            font-weight: 500;
    }
    
    .vw-lead .col-md-4 {
    background: #efefef;
}
    .vw-lead .col-md-4 .form-group {
    background: #efefef;
    padding: 10px 12px;
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 0;
    height: 100%;
}
    
    .vw-lead .control-label {
    font-weight: 500;
    height: 100%;
    /* vertical-align: top; */
    align-items: center;
    display: flex;
    justify-content: center;
    margin: 0;
}
    
    .vw-lead.form-body .col-md-8 {
    border: 1px solid #efefef;
    padding-right: 0 !important;
    max-width: 64.5% !important;
}
    
    .form-body.vw-lead {
    display: inline-block;
    width: 100%;
    padding-left: 15px;
}

    .vw-lead.form-body .form-group {
    margin-bottom: 0;
}

.vw-lead .form-body {
    padding-left:13px;
}
.col-md-6.show_lead .form-group input.form-control{
height:calc(2.5em + 1.75rem + 0px) !important;
}
    @media screen and (max-width: 767px) { 
  .vw-lead .col-md-8 .form-group input {
    text-align: center;
}

.vw-lead.form-body .col-md-8 { 
    max-width: 100% !important;
}

}
    
    
</style>

<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        @if(Auth::user()->is_admin == 1)
                        <?php  $last_url = redirect()->getUrlGenerator()->previous();  ?>
                        <li class="breadcrumb-item"><a href="{{ $last_url }}">View Campaign Leads</a></li>
                        @else
                        <li class="breadcrumb-item"><a href="{{ url('leads') }}">Leads</a></li>
                        @endif

                        @if(Auth::user()->is_admin == 1)
                        <?php  $last_url = redirect()->getUrlGenerator()->previous();  ?>
                        <li class="breadcrumb-item active">View Lead</li>
                        @else
                        <li class="breadcrumb-item active">View Leads</li>
                        @endif
                        
                        
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
                                <h4 class="m-b-0 text-white">View Leads</h4>
                            </div>

                            <div class="card-body">
                                <!--<h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>-->

                    
                          
                                    <div class="form-body vw-lead">
                                        
                                        <!--<div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Job Title</label>   
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">   
                                      
                                                            <input class="form-control" type="text" name="lead_name" value="{{$data['lead_name']}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Company Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                          
                                                            <input class="form-control" type="text" name="company_name" value="{{$data['company_name']}}" readonly>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>  
                                        </div>-->
                                        
                                            
                                     <div class="row p-t-20">
                                            <div class="col-md-6 show_lead">
                                                <div class="row ">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">First Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                               
                                                            <input class="form-control" type="text" name="first_name" value="{{$data['first_name']}}" readonly>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Last Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            
                                                            <input class="form-control" type="text" name="last_name" value="{{$data['last_name']}}" readonly>
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="row p-t-20">
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                           
                                                            <input class="form-control" type="text" name="email" value="{{$data['email']}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Campaign Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                     
                                                        <input class="form-control" type="text" name="source_name" value="{{$data['source']['source_name']}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="row p-t-20">
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Contact No 1</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                
                                                           <input class="form-control" type="text" name="phone_no" value="{{$data['phone_no']}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Contact No 2</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                      
                                                            <input class="form-control" type="text" name="phone_no2" value="{{$data['phone_no2']}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-t-20">
                                            
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Organization Industry</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text" name="industry" value="{{$data['industry']}}" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>   
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Organization</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                          
                                                            <input class="form-control" type="text" name="company_name" value="{{$data['company_name']}}" readonly>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>            
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Prospect Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                       
                                                        <input class="form-control" type="text" name="prospect_name" value="{{$data['prospect_name']}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Designation</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                       
                                                            <input class="form-control" type="text" name="designation" value="{{$data['designation']}}" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>             
                                        </div>
                

                                        <div class="row p-t-20">
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Linkedin Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                       
                                                        <input class="form-control" type="text" name="linkedin_address" value="{{$data['linkedin_address']}}" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>    
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label labelstyle">Bussiness Function</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                       
                                                            <input class="form-control" type="text" name="bussiness_function" value="{{$data['bussiness_function']}}" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>             
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Designation Level</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                  
                                                        <input class="form-control" type="text" name="designation_level" value="{{$data['designation_level']}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Timezone</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                            
                                                        <input class="form-control" type="text" name="timezone" value="{{$data['timezone']}}" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>             
                                        </div>
                                        <!--<div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Country</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                               
                                                        <input class="form-control" type="text" name="country" value="{{$data['country']}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Linkedin Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                       
                                                        <input class="form-control" type="text" name="linkedin_address" value="{{$data['linkedin_address']}}" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>             
                                        </div>-->

                                        <div class="row p-t-20">
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Location</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                       
                                                        <input class="form-control" type="text" name="location" value="{{$data['location']}}" readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>  
                                            <div class="col-md-6 show_lead">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Status</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                        @if($data['status'] == 1)
                                                    <span class="label label-warning statusbtnmargin">Pending</span>
                                                    @elseif($data['status'] == 2)
                                                    <span class="label label-danger statusbtnmargin">Failed</span>
                                                    @else
                                                    <span class="label label-success statusbtnmargin">Closed</span>
                                                    @endif</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Assign To</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                        @if($data['user'] != null)
                                                            <input style="width: auto;" class="form-control" type="text" name="asign_to" value="{{$data['user']['first_name'].' '.$data['user']['last_name']}}" readonly>
                                                            @if($data['user']['deleted_at'] != null)
                                                            <span class="label label-danger statusbtnmargin">Deleted</span>
                                                            @endif
                                                        @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div> -->            
                                        </div>

                                        <!-- <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label class="control-label labelstyle">Status</label><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                        @if($data['status'] == 1)
                                                    <span class="label label-warning statusbtnmargin">Pending</span>
                                                    @elseif($data['status'] == 2)
                                                    <span class="label label-danger statusbtnmargin">Failed</span>
                                                    @else
                                                    <span class="label label-success statusbtnmargin">Closed</span>
                                                    @endif</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                
                                            </div>             
                                        </div> -->
                                     
                               
                                   
                                       
                                        
                                    </div>

                            </div>
                        </div>

                    </div>
                </div>

               
        </div>
  
@endsection

