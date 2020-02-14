
<style>
.border-dark {
	border-color: #ccc;
}

.newFilter {
	margin-bottom: 20px;
}

.newFilter select.citySelect {
	width: 36%;
}

.chartBox {
	border-radius: 8px;
	border: 2px solid #eee;
	padding: 15px;
	font-family: 'Roboto', sans-serif;
	margin-bottom: 20px;
}

.chartBox .chartBox-head {
	padding: 0;
	font-size: 13px;
	color: #999;
	overflow: auto;
}

.chartBox .chartBox-head h2 {
	font-size: 13px;
	text-transform: uppercase;
	color: #044899;
	margin: 0;
	padding: 6px 0;
	float: left;
}

.chartBox .chartBox-head .chartLegends {
	float: right;
}

.chartBox .chartLegends {
	display: flex;
	justify-content: flex-end;
	font-size: 13px;
	color: #999;
	margin: 0;
	padding: 0;
}

.chartBox .chartLegends li {
	display: inline-flex;
	padding: 5px 8px;
	align-items: center;
	margin: 0;
}

.chartBox .chartLegends li b {
	margin-right: 4px;
}

.chartBox .chartLegends li b.circleBox {
	width: 11px;
	height: 11px;
	background: #fff;
	border-radius: 50%;
	border: 2px solid #000;
	margin-top: -2px;
}

.chartBox .chartLegends li b.lineBox {
	width: 15px;
	height: 6px;
	background: #000;
	margin-top: -2px;
	border-radius: 5px;
}

.chartBox .chartLegends.twoDivide {
	flex-wrap: wrap;
	justify-content: normal;
}

.chartBox .chartLegends.twoDivide li {
	width: 50%;
}
/*****/

.dispensedWrap {
	margin-bottom: 25px;
	display: inline-block;
	width: 100%;
}

.dispensedWrap h2 {
	font-size: 13px;
	text-transform: uppercase;
	color: #044899;
	margin: 0;
	padding: 6px 20px;
	float: left;
}

.dispensedWrap .tablewrap {
	border: 1px solid #cfcfcf;
	border-radius: 6px;
	display: inline-block;
	width: 100%;
	overflow: hidden;
}

.dispensedWrap .tablewrap .dataTable {
	border-top: 0px;
}

.dispensedWrap .tablewrap .dataTable>tbody>tr:last-child>td {
	border: 0;
}

.subtitile {
	display: inline-block;
	vertical-align: middle;
	text-transform: uppercase;
	font-size: 12px;
	color: #4c4c4c;
	padding-top: 4px;
	padding-left: 5px;
}

.quanValueWrap {
	padding-bottom: 18px;
}

.quanValueWrap span {
	padding: 0 60px;
}

.quanValueWrap span:first-child {
	border-right: 1px solid #eeeeee;
}

.quanValueWrap span b {
	padding-left: 5px;
}
</style>

<body>
    <header>
		<?php echo $this->element("left_panel"); ?>
	</header>
    <div class="main-wraper">
        <div class="container">
            <div class="row">
                <ul class="customHeadWrap">
                    <li class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                        <div class="customHead"> <b><i class="sprite customerIcon"></i></b> <span>View Account Details</span> </div>
                    </li>
                    <li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="searchclient">
                            <input type="text" placeholder="Search Patients"> <b><img src="<?php echo PATH."img/doctor/icons-search.png" ?>"></b></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 text-right">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="<?php echo $this->Url->build(["controller"=>"Report","action"=>"details"]); ?>">Details</a></li>
                        <li class="active"><a href="<?php echo $this->Url->build(["controller"=>"Report","action"=>"dashboard"]); ?>">Dashboard</a></li>
                    </ul>
                </div>
            </div>
            <div class="customerlistWrap">
                <div class="tab-content">
                    <div id="todayvisitsTab" class="tab-pane fade in active">

                        <div class="clearfix">
                            <div class="row filterBar newFilter">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dateText">
                                        <input type="text" id="overAllDate" class="hiddenCld" />
                                        <label>From</label>
                                        <span id="aboveStartDate" data-id="09/26/2018">26 Sep 2018</span>
                                        <label>To</label>
                                        <span id="aboveEndDate" data-id="09/26/2018">26 Sep 2018</span> <b class="clderIcon sprite callCld"></b></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="filterBox">
                                        <label>City</label>
                                        <select class="form-control citySelect">
								<option>All</option>
								<option>City_01</option>
							  </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-dark">

                            <div class="text-center quanValueWrap">
                                <span>Value of Medicine Dispensed:<b>INR 3,560</b></span>
                                <span>Quantity of Medicine Dispensed:<b>56</b></span>
                            </div>

                            <hr class="border-dark">
                            <div class="clearfix">
                                <div class="col-sm-12">
                                    <div class="chartBox">
                                        <div class="chartBox-head">
                                            <h2>Patients Registered</h2>

                                        </div>
                                        <div class="chartBox-body">
                                            <div id="registeredPat" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="dispensedWrap">
                                <div class="col-12 col-sm-6">
                                    <h2>Dispensed Medicine</h2>
                                    <div class="tablewrap">
                                        <table id="customerTable" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Madicine Name</th>
                                                    <th>Madicine Type</th>
                                                    <th>QTY Dispensed</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="javascript:void(0);" class="userName">Combiflam</a></td>
                                                    <td>Tablets</td>
                                                    <td><span class="conNumber">48</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);" class="userName">Combiflam</a></td>
                                                    <td>Tablets</td>
                                                    <td><span class="conNumber">48</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);" class="userName">Combiflam</a></td>
                                                    <td>Tablets</td>
                                                    <td><span class="conNumber">48</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);" class="userName">Combiflam</a></td>
                                                    <td>Tablets</td>
                                                    <td><span class="conNumber">48</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h2>Dispensed By</h2>
                                    <div class="tablewrap">
                                        <table id="dispenTable" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Doctor Name</th>
                                                    <th>QTY Dispensed</th>
                                                    <th>Value(INR)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="javascript:void(0);" class="userName">Rajesh Kumar Singh</a></td>
                                                    <td>12</td>
                                                    <td><span class="conNumber">1,520</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);" class="userName">Kabir Bedi</a></td>
                                                    <td>10</td>
                                                    <td><span class="conNumber">484</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);" class="userName">Sumit</a></td>
                                                    <td>18</td>
                                                    <td><span class="conNumber">596</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);" class="userName">Neeraj</a></td>
                                                    <td>18</td>
                                                    <td><span class="conNumber">596</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix mt-5">
                                <div class="col-sm-12">
                                    <div class="chartBox">
                                        <div class="chartBox-head">
                                            <div class="col-sm-12 col-md-6">
                                                <h2>Top Dispensed Medicine</h2><span class="subtitile">:Disprin</span>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="filterBox">
                                                    <label>Other Medicine</label>
                                                    <select class="form-control citySelect">
                                                <option>Medicine 01</option>
                                                <option>Medicine 02</option>
                                                <option>Medicine 03</option>
                                              </select>
                                                </div>
                                            </div>

                                        </div>
                                        <hr class="border-dark" style="margin: 12px 0;">
                                        <div class="chartBox-body">
                                            <div id="disprinChart" style="width:100%; height:300px;"></div>
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
    <!-- FOOTER -->
    <footer>
        <div class="container">
            <ul class="nav nav-pills customHeader">
                <li><a href="index.html" title="Home">Home</a></li>
                <li><a href="offer.html" title="What We Offer">What We Offer</a></li>
                <li><a href="aboutus.html" title="About Us">About Us</a></li>
                <li><a href="testimonials .html" title="Testimonials ">Testimonials </a></li>
                <li><a href="contactus.html" title="Contact Us">Contact Us</a></li>
            </ul>
            <div class="sociallinkWrap">
                <p><span>Follow Us</span></p>
                <ul>
                    <li><a href="javascript:void(0);" title="Facebook"><i class="sprite fbIcon"></i></a></li>
                    <li><a href="javascript:void(0);" title="Linkdin"><i class="sprite linkdinIcon"></i></a></li>
                    <li><a href="javascript:void(0);" title="Twitter"><i class="sprite twitterIcon"></i></a></li>
                    <li><a href="javascript:void(0);" title="Youtube"><i class="sprite youtubeIcon"></i></a></li>
                </ul>
            </div>
            <div class="policylink"> <a href="privicy.html">Privicy Policy</a> <a href="terms.html">Terms &amp; Conditions</a> </div>
            <div class="copyright">
                <p>Copyright DocPharmRx 2018</p>
            </div>
        </div>
    </footer>
    <!-- Modal -->
    <div id="createpatient-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New Patient</h4>
                </div>
                <div class="modal-body clearfix">
                    <form class="create-patient-form clearfix">
                        <fieldset class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="customformwrap">
                                <label class="customLabel">Title</label>
                                <select class="custominput singleselect ">
									<option>Ms. </option>
									<option>Mrs.</option>
									<option>Mr.</option>
								</select>
                            </div>
                        </fieldset>
                        <fieldset class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="customformwrap">
                                <label class="customLabel">First Name</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="customformwrap">
                                <label class="customLabel">Middle Name</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="customformwrap">
                                <label class="customLabel">Last Name</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="customformwrap">
                                <label class="customLabel">Gender</label>
                                <select class="custominput singleselect ">
									<option>Male</option>
									<option>Female</option>
								</select>
                            </div>
                        </fieldset>
                        <fieldset class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label class="datebirtdTitle clearfix">Date Of Birth</label>
                            <div class="customformwrap dateslt">
                                <select class="custominput singleselect ">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
									<option>7</option>
									<option>8</option>
									<option>9</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
									<option>13</option>
									<option>14</option>
									<option>15</option>
									<option>16</option>
									<option>17</option>
									<option>18</option>
									<option>19</option>
									<option>20</option>
									<option>21</option>
									<option>22</option>
									<option>23</option>
									<option>24</option>
									<option>25</option>
									<option>26</option>
									<option>27</option>
									<option>28</option>
									<option>29</option>
									<option>30</option>
								</select>
                            </div>
                            <div class="customformwrap monthslt">
                                <select class="custominput singleselect ">
									<option>Jan</option>
									<option>Feb</option>
									<option>Mar</option>
									<option>Apr</option>
									<option>May</option>
									<option>Jun</option>
									<option>July</option>
									<option>Aug</option>
									<option>Sep</option>
									<option>Oct</option>
									<option>Nov</option>
									<option>Dec</option>
								</select>
                            </div>
                            <div class="customformwrap yearslt">
                                <select class="custominput singleselect ">
									<option>1991</option>
									<option>1992</option>
									<option>1993</option>
									<option>1994</option>
									<option>1995</option>
									<option>1996</option>
									<option>1997</option>
									<option>1998</option>
									<option>1999</option>
									<option>2000</option>
									<option>2001</option>
									<option>2002</option>
									<option>2003</option>
									<option>2004</option>
									<option>2005</option>
									<option>2006</option>
									<option>2007</option>
									<option>2008</option>
									<option>2009</option>
									<option>2010</option>
									<option>2011</option>
									<option>2012</option>
									<option>2013</option>
									<option>2014</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>
								</select>
                            </div>
                        </fieldset>
                        <fieldset class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="customformwrap">
                                <label class="customLabel">Mobile Number</label>
                                <input type="text" class="custominput inputwith-abbbtn">
                                <div class="addmoreBtn patinumclick "><b class="sprite addplusIcon "></b></div>
                            </div>
                            <div class="customformwrap patiothernumber">
                                <label class="customLabel ">Other Number</label>
                                <input type="text" class="custominput inputwith-abbbtn"> </div>
                        </fieldset>
                        <fieldset class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="customformwrap">
                                <label class="customLabel">Email Address</label>
                                <input type="text" class="custominput inputwith-abbbtn" value="bhavyasinghsharma@gmail.com" />
                                <div class="addmoreBtn patiemailclick "><b class="sprite addplusIcon"></b></div>
                            </div>
                            <div class="customformwrap patiotheremail">
                                <label class="customLabel">Email Address</label>
                                <input type="text" class="custominput inputwith-abbbtn" value="bhavyasinghsharma@gmail.com" /> </div>
                        </fieldset>
                        <fieldset class="address-fieldset col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="customformwrap">
                                <label class="customLabel">Address</label>
                                <input type="text" class="custominput">
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset class="contryformwrap col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                                <label class="customLabel">Country</label>
                                <select class="custominput singleselect ">
									<option></option>
									<option>India</option>
								</select>
                            </div>
                            <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                                <label class="customLabel">State</label>
                                <select class="custominput singleselect ">
									<option></option>
									<option>Delhi</option>
								</select>
                            </div>
                        </fieldset>
                        <fieldset class="contryformwrap col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                                <label class="customLabel">City</label>
                                <select class="custominput singleselect ">
									<option></option>
									<option>Delhi</option>
								</select>
                            </div>
                            <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                                <label class="customLabel">Pincode</label>
                                <input type="text" class="custominput" value="110032"> </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer text-center clearfix">
                    <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary text-uppercase">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- EDIT APP Modal -->
    <div id="createpatient-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Patient</h4>
                </div>
                <div class="modal-body">
                    <form class="create-patient-form">
                        <fieldset>
                            <div class="customformwrap">
                                <label class="customLabel">First Name</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset>
                            <div class="customformwrap">
                                <label class="customLabel">Middle Name</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset>
                            <div class="customformwrap">
                                <label class="customLabel">Last Name</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset>
                            <label class="datebirtdTitle clearfix">Date Of Birth</label>
                            <div class="customformwrap dateslt">
                                <select class="custominput singleselect ">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
									<option>7</option>
									<option>8</option>
									<option>9</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
									<option>13</option>
									<option>14</option>
									<option>15</option>
									<option>16</option>
									<option>17</option>
									<option>18</option>
									<option>19</option>
									<option>20</option>
									<option>21</option>
									<option>22</option>
									<option>23</option>
									<option>24</option>
									<option>25</option>
									<option>26</option>
									<option>27</option>
									<option>28</option>
									<option>29</option>
									<option>30</option>
								</select>
                            </div>
                            <div class="customformwrap monthslt">
                                <select class="custominput singleselect ">
									<option>Jan</option>
									<option>Feb</option>
									<option>Mar</option>
									<option>Apr</option>
									<option>May</option>
									<option>Jun</option>
									<option>July</option>
									<option>Aug</option>
									<option>Sep</option>
									<option>Oct</option>
									<option>Nov</option>
									<option>Dec</option>
								</select>
                            </div>
                            <div class="customformwrap yearslt">
                                <select class="custominput singleselect ">
									<option>1991</option>
									<option>1992</option>
									<option>1993</option>
									<option>1994</option>
									<option>1995</option>
									<option>1996</option>
									<option>1997</option>
									<option>1998</option>
									<option>1999</option>
									<option>2000</option>
									<option>2001</option>
									<option>2002</option>
									<option>2003</option>
									<option>2004</option>
									<option>2005</option>
									<option>2006</option>
									<option>2007</option>
									<option>2008</option>
									<option>2009</option>
									<option>2010</option>
									<option>2011</option>
									<option>2012</option>
									<option>2013</option>
									<option>2014</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>
								</select>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="customformwrap">
                                <label class="customLabel">Mobile Number</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset>
                            <div class="customformwrap">
                                <label class="customLabel">Email Address</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset class="address-fieldset">
                            <div class="customformwrap">
                                <label class="customLabel">Address</label>
                                <input type="text" class="custominput">
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                        <fieldset class="contryformwrap">
                            <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                                <label class="customLabel">Country</label>
                                <select class="custominput singleselect ">
									<option>1</option>
								</select>
                            </div>
                            <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                                <label class="customLabel">State</label>
                                <select class="custominput singleselect ">
									<option>1</option>
								</select>
                            </div>
                        </fieldset>
                        <fieldset class="contryformwrap">
                            <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                                <label class="customLabel">City</label>
                                <select class="custominput singleselect ">
									<option>1</option>
								</select>
                            </div>
                            <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                                <label class="customLabel">Pincode</label>
                                <input type="text" class="custominput"> </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary text-uppercase">Add</button>
                </div>
            </div>
        </div>
    </div>
    <div id="viewdetails-Modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">View Patient Details</h4>
                </div>
                <div class="modal-body">
                    <div class="viewmodalOrder">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul>
                                    <li>
                                        <div class="customformwrap">
                                            <label class="customLabel">PHONE NUMBER</label>
                                            <p>Bhavya Sharma</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="customformwrap">
                                            <label class="customLabel">Phone Number</label>
                                            <p>+91 9685XXXX52, +91 7625XXX781</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="customformwrap">
                                            <label class="customLabel">AGE (DATE OF BIRTH)</label>
                                            <p>21 (03 Apr 1995)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="customformwrap">
                                            <label class="customLabel">Email</label>
                                            <p>bhavyasinghsharma@gmail.com</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="customformwrap">
                                            <label class="customLabel">Address</label>
                                            <p> #03 - Ground Floor A-42/6, Pinnacle Tower, Sector 62, Noida, Uttar Pradesh 201301</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="centerAlign">
                        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Done</button>
                        <button type="button" class="btn btn-primary text-uppercase" data-toggle="modal" data-target="#createpatient-Modal">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Months', 'Total Patients', 'New Patients', 'Repeat Patients'],
                ['Jan 19', 900, 400, 200],
                ['Feb 19', 700, 200, 960],
                ['Mar 19', 800, 90, 120],
                ['Apr 19', 600, 150, 150],
                ['May 19', 100, 550, 70],
                ['Jun 19', 200, 630, 350],
                ['Jul 19', 200, 790, 356],
                ['Aug 19', 900, 450, 965],
                ['Sep 19', 890, 350, 321],
                ['Oct 19', 200, 660, 452],
                ['Nov 19', 700, 750, 268],
                ['Dec 19', 900, 950, 125],

            ]);

            var options = {
                title: '',
                colors: ['#a37ffd', '#7db6d4', '#458ccc'],
                chartArea: {
                    left: 40,
                    top: 30,
                    width: '95%',
                    height: '76%'
                },
                pointSize: 7,
                legend: {
                    position: "none"
                },
                hAxis: {
                    title: '',
                    slantedText: false,
                    maxAlternation: 5,
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }
                },
                vAxis: {
                    minValue: 0,
                    baselineColor: '#aaa',
                    gridlines: {
                        color: '#eee',
                        count: 5
                    },
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('registeredPat'));
            chart.draw(data, options);
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Months', 'Total Patients'],
                ['Jan 19', 900],
                ['Feb 19', 700],
                ['Mar 19', 800],
                ['Apr 19', 600],
                ['May 19', 100],
                ['Jun 19', 200],
                ['Jul 19', 200],
                ['Aug 19', 900],
                ['Sep 19', 890],
                ['Oct 19', 200],
                ['Nov 19', 700],
                ['Dec 19', 900],

            ]);

            var options = {
                title: '',
                lineWidth: 0,
                colors: ['#a37ffd', '#7db6d4', '#458ccc'],
                chartArea: {
                    left: 60,
                    top: 30,
                    width: '95%',
                    height: '76%'
                },
                pointSize: 14,
                legend: {
                    position: "none"
                },
                hAxis: {
                    title: '',
                    slantedText: false,
                    maxAlternation: 5,
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }
                },
                vAxis: {
                    title: 'Quantity Dispensed',
                    minValue: 0,
                    baselineColor: '#aaa',
                    gridlines: {
                        color: '#eee',
                        count: 5
                    },
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('disprinChart'));
            chart.draw(data, options);
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#customerTable').DataTable({
                responsive: true,
                info: false,
                paging: false,
                searching: false,
                ordering: false
            });
            $('#dispenTable').DataTable({
                responsive: true,
                info: false,
                paging: false,
                searching: false,
                ordering: false
            });
            $('.menutoggle').click(function() {
                $(this).toggleClass('active');
                $('header').toggleClass('active');
            });
            $(document).on('show.bs.modal', '.modal', function(event) {
                var zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                }, 0);
            });



        });
        $(window).resize(function() {

            drawChart();

        });
    </script>
</body>

</html>