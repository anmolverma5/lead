@extends('layouts.admin')

 
@section('content')


<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('leads') }}">Leads</a></li>
                        <li class="breadcrumb-item active">Edit Lead</li>
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
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Edit Lead</h4>
                            </div>
                            <div class="card-body">
                               <form method='post' action="{{route('leads.update', [$data->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <div class="form-body">
                                        <!--<h3 class="card-title">Edit Lead Details</h3>
                                        <hr>-->

                                           
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Select Source</label>
                                                    <select  name="source_id" class="form-control custom-select" data-placeholder="Select Source" tabindex="1">
                                                        <option value="">Select Source</option>
                                                        @foreach($sources as $sources)
                                                            @if ($data->source_id == $sources['id'])
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
                                            </div>


                                            <!--<div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Company Name</label>
                                                    <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Enter Company Name" value="{{ $data->company_name }}">
                                                    @if($errors->has('company_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('company_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>-->
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" id="email" name="email" class="form-control form-control-danger" placeholder="Enter Email" value="{{ $data->email }}">
                                                    @if($errors->has('email'))
                                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!--/span-->
                                        </div>

                              

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter First Name" value="{{ $data->first_name }}">
                                                    @if($errors->has('first_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('first_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" id="last_name" name="last_name" class="form-control form-control-danger" placeholder="Enter Last Name" value="{{ $data->last_name }}">
                                                    @if($errors->has('last_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('last_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>


                                         <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="control-label">Organization  Industry</label>
                                                    <input type="text" id="industry" name="industry" class="form-control" placeholder="Enter Organization Industry" value="{{ $data->industry }}">
                                                    @if($errors->has('industry'))
                                                        <div class="alert alert-danger">{{ $errors->first('industry') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="control-label">Organization</label>
                                                    <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Enter Company Name" value="{{ $data->company_name }}">
                                                    @if($errors->has('company_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('company_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>


                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Contact No </label>
                                                    <input type="text" id="phone_no" name="phone_no" class="form-control" placeholder="Enter Contact No" value="{{ $data->phone_no }}">
                                                    @if($errors->has('phone_no'))
                                                        <div class="alert alert-danger">{{ $errors->first('phone_no') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Another Contact No</label>
                                                    <input type="text" id="phone_no2" name="phone_no2" class="form-control form-control-danger" placeholder="Enter Another No" value="{{ $data->phone_no2 }}">
                                                    @if($errors->has('phone_no2'))
                                                        <div class="alert alert-danger">{{ $errors->first('phone_no2') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>


                                      <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label class="control-label">Prospect Name</label>
                                                    <input type="text" id="prospect_name" name="prospect_name" class="form-control" placeholder="Enter Prospect Name" value="{{ $data->prospect_name }}">
                                                    @if($errors->has('prospect_name'))
                                                        <div class="alert alert-danger">{{ $errors->first('prospect_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Designation</label>
                                                    <input type="text" id="designation" name="designation" class="form-control form-control-danger" placeholder="Enter Designation" value="{{ $data->designation }}">
                                                    @if($errors->has('designation'))
                                                        <div class="alert alert-danger">{{ $errors->first('designation') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                        </div>


                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                   <label class="control-label">Linkedin Address</label>
                                                    <input type="text" id="linkedin_address" name="linkedin_address" class="form-control" placeholder="Enter Linkedin Address" value="{{ $data->linkedin_address }}">
                                                    @if($errors->has('linkedin_address'))
                                                        <div class="alert alert-danger">{{ $errors->first('linkedin_address') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Bussiness Function</label>
                                                    <input type="text" id="bussiness_function" name="bussiness_function" class="form-control form-control-danger" placeholder="Enter Bussiness Function" value="{{ $data->bussiness_function }}">
                                                    @if($errors->has('bussiness_function'))
                                                        <div class="alert alert-danger">{{ $errors->first('bussiness_function') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Designation Level</label>
                                                    <input type="text" id="designation_level" name="designation_level" class="form-control" placeholder="Enter Designation Level" value="{{ $data->designation_level }}">
                                                    @if($errors->has('designation_level'))
                                                        <div class="alert alert-danger">{{ $errors->first('designation_level') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                        </div>


                                        <!-- <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">City</label>
                                                    <input type="text" id="city" name="city" class="form-control" placeholder="Enter City" value="{{ $data->city }}">
                                                    @if($errors->has('city'))
                                                        <div class="alert alert-danger">{{ $errors->first('city') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">State</label>
                                                    <input type="text" id="state" name="state" class="form-control form-control-danger" placeholder="Enter State" value="{{ $data->state }}">
                                                    @if($errors->has('state'))
                                                        <div class="alert alert-danger">{{ $errors->first('state') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>-->

                                       <!--  <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Zip Code</label>
                                                    <input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="Enter Zip Code" value="{{ $data->zip_code }}">
                                                    @if($errors->has('zip_code'))
                                                        <div class="alert alert-danger">{{ $errors->first('zip_code') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Country</label>
                                                    <input type="text" id="country" name="country" class="form-control form-control-danger" placeholder="Enter Country" value="{{ $data->country }}">
                                                    @if($errors->has('country'))
                                                        <div class="alert alert-danger">{{ $errors->first('country') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                        </div>

                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Linkedin Address</label>
                                                    <input type="text" id="linkedin_address" name="linkedin_address" class="form-control" placeholder="Enter Linkedin Address" value="{{ $data->linkedin_address }}">
                                                    @if($errors->has('linkedin_address'))
                                                        <div class="alert alert-danger">{{ $errors->first('linkedin_address') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                        </div>-->






                                     
                                
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                         <input type="reset" class="btn btn-inverse" value="Cancel" />
                                            <a href="{{ url('leads') }}"><button type="button" class="btn btn-info">Back</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
        
               
        </div>
  
@endsection

