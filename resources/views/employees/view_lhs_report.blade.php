@extends('layouts.admin')
@section('content')
<style type="text/css">
.control-label {
    font-weight: 500;
}

.vw-lead .col-md-4 {
    background: #fff;
}

.vw-lead .col-md-4 .form-group {
    background: #ffffff;
    padding: 10px 15px;
    text-align: center;
    text-transform: uppercase;
    height: 100%;
    left: 14px;
    position: absolute;
    top: -8px;
    z-index: 5;
    padding-left: 8px;
}

.vw-lead .control-label {
    font-weight: 500;
    height: 100%;
    /* vertical-align: top; */
    align-items: center;
    display: flex;
    justify-content: center;
    margin: 0;
    color: #222;
    font-weight: 600;
}

.vw-lead.form-body .col-md-8 {
    border: 1px solid #efefef;
    padding-right: 0 !important;
    max-width: 64.5% !important;
    padding: 0;
}

.form-body.vw-lead {
    display: inline-block;
    width: 100%;
    padding-left: 15px;
}

.vw-lead.form-body .form-group {
    margin-bottom: 0;
}

.vw-lead.form-body .form-group .statusbtnmargin {
    margin-bottom: 16px;
    margin-left: 20px;
}

.vw-lead .form-body {
    padding-left: 13px;
}

.col-md-6.show_lead .form-group input.form-control {
    /* height:calc(2.5em + 1.75rem + 0px) !important; */
    height: 47px !important;
    color: #747474;
    padding-left: 20px;
}

.col-md-6.show_lead .form-group input.form-control::-webkit-input-placeholder {
    color: #747474;
}

.col-md-6.show_lead .form-group input.form-control:-ms-input-placeholder {
    /* Internet Explorer 10-11 */
    color: #747474;
}

.col-md-6.show_lead .form-group input.form-control::placeholder {
    color: #747474;
}


/* new css added 30-12-2021*/
p.Heraeus {
    padding: 20px 20px;
    font-size: 14px;
    line-height: 1.9;
}

.form-body.vd-frm .row > div {
    display: flex;
    flex: 0 0 48%;
    max-width: 48%;
    position: relative;
}

.form-body.vd-frm .row {
    justify-content: space-between;
}

.form-body.vd-frm .row > div > div > div {
    flex: 0 0 100%;
    max-width: 100%;
}

.form-body.vd-frm .row > div > div {
    flex: 0 0 100%;
    max-width: 100%;
    position: relative;
}

.form-body.vd-frm .row > div > div > div:first-child {
    position: absolute;
    left: 20px;
    top: -20px;
    z-index: 2;
    background: #fff;
    display: inline;
    flex: 0 0 auto;
    max-width: initial;
    width: auto;
    height: 50%;
    padding: 0 8px;
}

.form-body.vd-frm .row > div > div > div .form-control {
    padding: 12px;
    font-weight: 500;
}
.vd-frm .control-label {
    font-weight: 700;
    color: #222;
    text-transform: uppercase;
}
.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgb(17 57 155 / 43%);
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
                    <h4 class="m-b-0 text-white">View page</h4>
                </div>
                <div class="card-body">
                    <div class="form-body vw-lead">
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Contact's Name:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="first_name" value="CONTACT'S NAME"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Board Number:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="last_name" value="Board Number" readonly>
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
                                            <label class="control-label labelstyle">Contact's Designation:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="email" value="Contact's Designation" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Direct Number:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="source_name" value="Direct Number"
                                                readonly>
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
                                            <label class="control-label labelstyle">Company:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="phone_no" value="Company" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Ext (if any):</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="phone_no2" value="Ext" readonly>
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
                                            <label class="control-label labelstyle">Industry:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="industry" value="Industry" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Cell Number:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="company_name" value="Cell Number"
                                                readonly>
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
                                            <label class="control-label labelstyle">Employees:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="prospect_name" value="Employees"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Email:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="designation" value="Email"
                                                readonly>
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
                                            <label class="control-label labelstyle">Revenue:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="linkedin_address" value="Revenue"readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">EA Name:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="bussiness_function" value="EA Name"
                                                readonly>
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
                                            <label class="control-label labelstyle">Address:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="designation_level" value="Address:" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">EA Phone Number:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="timezone" value="EA Phone Number" readonly>
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
                                            <label class="control-label labelstyle">LinkedIn Profile:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location" value="LinkedIn Profile" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">EA Email:</label><br>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location" value="EA Email" readonly>
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
                                            <label class="control-label labelstyle">Prospect Level:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location" value="Prospect Level" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Website:</label><br>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location" value="Website" readonly>
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
                                            <label class="control-label labelstyle">Prospect Vertical:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location" value="Prospect Vertical" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Opt-in Status:</label><br>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="location" value="Opt-in Status" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Company Description</h4>
                </div>
                <p class="Heraeus">Heraeus is an international family-owned technology group headquartered in Hanau,
                    Germany formed in 1851. Heraeus, Inc. provides technology and metal services. The Company serves
                    chemical, metals, energy, communications, electronics, health, and industrial application sectors.
                    Heraeus operates Worldwide. Heraeus is focused on precious and special metals, medical technology,
                    quartz glass, sensors and specialty light sources. Heraeus supplies products to manufacturing
                    companies in the automotive sector, the aerospace sector, telecommunications, the chemical industry,
                    medical technology and the steel industry. Heraeus Quarzglas specializes in the manufacture and
                    processing of high-purity quartz glass. This GBUt manufactures quartz glass for the semiconductor
                    industry and telecommunication industry as well as for applications in the optical industry,
                    chemical industry and lamp industries. This GBU specializes in the development of products and
                    solutions for the chemical industry and pharmaceutical industry. In addition to catalysts, it also
                    sells pharmaceutical ingredients. This GBU manufactures products for the electronics, consumer goods
                    and automotive industries. These include bonding wires and assembly materials for integrated circuit
                    and mounting technologies, as well as miniaturized electronics components such as thick film pastes,
                    powders and conductive polymers.</p>
                <div class="card-header">
                    <h4 class="m-b-0 text-white">and</h4>
                </div>
                <div class="card-body">
                    <div class="form-body vw-lead Manfred">
                        <div class="row p-t-20">
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Responsibilities:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="first_name" value="" readonly="">Manfred mentioned that he is the Head of Supply Chain Excellence at Heraeus Electronics in Germany. He mentioned that he manages the supply chain process in order to ensure a seamless logistics experience for the customers. He said that he oversees the optimization of supply chain and functionality for planning, scheduling, analysis, demand Management, Order Management, Inventory Management and other Supply Chain functions.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Team Size:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="first_name" value="" readonly="">He mentioned that he heads different teams but didn’t specify a number.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Pain Areas:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="first_name" value="" readonly="">He mentioned that there is nothing speicifc, however he could discuss about them during the discussion.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Interest/New Initiatives:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="first_name" value="" readonly="">Manfred mentioned that he would be really interested in knowing about Wipro's capabilities and offerings around Supply Chain. He said that he would like to know what expertise Wipro has in Supply Chain operations. He mentioned that he is keen to know about Wipro's experience in working with companies similar to Heraeus.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Budget:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="first_name" value="" readonly="">250000K</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Defined Agenda:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="first_name" value="" readonly="">A detailed overview of Wipro. Discussion around his topics of interest and about acquisitions that Wipro has made around his responsible areas along with relevant use cases.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 show_lead">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Call Notes:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" name="first_name" value="" readonly="">a) He said he is not familiar with Wipro. Therefore, gave him a brief introduction of Wipro as well as offerings in supply chain. b) He is interested in knowing about Wipro's capabilities and offerings in the Supply Chain and Logistics domain. c) He asked to share with him a 30 minutes invite for either the 9th or the 10th of December for the suggested time slot. d) He mentioned that he is keen to know about Wipro's expertise in the supply chain domain and experience in working with companies similar to Heraeus.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                     <div class="col-md-6 mb-3 show_lead">
                        <div class="row">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                           <div class="col-md-8">
                              <div class="form-group">
                                 <textarea class="form-control" type="text" name="email" value="" readonly>Does the prospect wish to have a Face to Face meeting or teleconference?</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3 show_lead">
                        <div class="row">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Direct Number:</label>
                              </div>
                           </div> -->
                           <div class="col-md-8">
                              <div class="form-group">
                                 <textarea class="form-control" type="text" name="source_name" value="" readonly>Teleconference</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3 show_lead">
                        <div class="row">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                           <div class="col-md-8">
                              <div class="form-group">
                                 <textarea class="form-control" type="text" name="email" value="" readonly>Is the contact the decision maker? If No, then who is?</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3 show_lead">
                        <div class="row">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                           <div class="col-md-8">
                              <div class="form-group">
                                 <textarea class="form-control" type="text" name="email" value="" readonly>Yes</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3 show_lead">
                        <div class="row">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                           <div class="col-md-8">
                              <div class="form-group">
                                 <textarea class="form-control" type="text" name="email" value="" readonly>Who else would be the influencers in the decision making process?</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3 show_lead">
                        <div class="row">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                           <div class="col-md-8">
                              <div class="form-group">
                                 <textarea class="form-control" type="text" name="email" value="" readonly>NA</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3 show_lead">
                        <div class="row">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                           <div class="col-md-8">
                              <div class="form-group">
                                 <textarea class="form-control" type="text" name="email" value="" readonly>Is the Company already affiliated with any other similar services? If Yes, Name?</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 mb-3 show_lead">
                        <div class="row">
                           <!-- <div class="col-md-4">
                              <div class="form-group">
                                 <label class="control-label labelstyle">Contact's Designation:</label>
                              </div>
                           </div> -->
                           <div class="col-md-8">
                              <div class="form-group">
                                 <textarea class="form-control" type="text" name="email" value="" readonly>NA</textarea>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Meeting Information</h4>
                </div>
                <div class="card-body">
                    <div class="form-body vd-frm">
                    <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Date 1:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                        <input type="text" value="15:00 CET" class="form-control" name="first_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Time 1:(24 Hours format)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                        <input type="text" value="15:00 CET" class="form-control" name="first_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-20">
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Date 1:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                        <input type="text" value="15:00 CET" class="form-control" name="first_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 show_lead">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label labelstyle">Time 1:(24 Hours format)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="text" value="15:00 CET" class="form-control" name="first_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection