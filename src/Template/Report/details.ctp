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
                        <li class="active"><a href="<?php echo $this->Url->build(["controller"=>"Report","action"=>"details"]); ?>">Details</a></li>
                        <li class=""><a href="<?php echo $this->Url->build(["controller"=>"Report","action"=>"dashboard"]); ?>">Dashboard</a></li>
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
                            <div class="clearfix">
                                <div class="col-sm-7">
                                    <div class="chartBox">
                                        <div class="chartBox-head">
                                            <h2>Patients Registered</h2>
                                            <ul class="chartLegends">
                                                <li><b class="circleBox" style="border-color:#a37ffd;"></b> Total</li>
                                                <li><b class="lineBox" style="background:#7db6d4;"></b>New</li>
                                                <li><b class="lineBox" style="background:#458ccc;"></b>Repeat</li>
                                            </ul>
                                        </div>
                                        <div class="chartBox-body">
                                            <div id="registeredPat" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="chartBox">
                                        <div class="chartBox-head">
                                            <h2>No. of appointments created</h2>
                                        </div>
                                        <div class="chartBox-body">
                                            <div id="appointmentCreate" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="chartBox">
                                        <div class="chartBox-head">
                                            <h2>Doctors Registered</h2>
                                            <ul class="chartLegends">

                                                <li><b class="lineBox" style="background:#458ccc;"></b>Booked</li>
                                                <li><b class="lineBox" style="background:#7db6d4;"></b>Cancelled</li>
                                            </ul>
                                        </div>
                                        <div class="chartBox-body">
                                            <div id="registeredDoc" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="chartBox">
                                        <div class="chartBox-head">
                                            <h2>No. of prescriptions</h2>
                                            <ul class="chartLegends">
                                                <li><b class="lineBox" style="background:#3593d0;"></b>Issued</li>
                                                <li><b class="lineBox" style="background:#7fcbfd;"></b>Dispensed</li>
                                            </ul>
                                        </div>
                                        <div class="chartBox-body">
                                            <div id="prescriptionCount" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="chartBox">
                                        <div class="chartBox-head">
                                            <h2>Top 10 Pharmacies</h2>
                                        </div>
                                        <div class="chartBox-body">
                                            <div id="pharmacieTop" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="chartBox">
                                        <div class="chartBox-head">
                                            <h2>Distribution of account types</h2>
                                        </div>
                                        <div class="chartBox-body">
                                            <div id="distributionAc" style="width:100%; height:245px;"></div>
                                            <ul class="chartLegends twoDivide">
                                                <li><b class="lineBox" style="background:#5574ba;"></b>Ultrasound</li>
                                                <li><b class="lineBox" style="background:#8aa3e3;"></b>Blood Test</li>
                                                <li><b class="lineBox" style="background:#7ca7d9;"></b>Thyroid Profile</li>
                                                <li><b class="lineBox" style="background:#448bcb;"></b>MRI</li>
                                                <li><b class="lineBox" style="background:#8681bd;"></b>EKG</li>



                                            </ul>
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

            var chart = new google.visualization.LineChart(document.getElementById('saletrends'));
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
        google.charts.load("current", {
            packages: ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Month", "Appointments"],
                ['Jan 19', 300],
                ['Feb 19', 600],
                ['Mar 19', 200],
                ['Apr 19', 600],
                ['May 19', 100],
                ['Jun 19', 200],
                ['Jul 19', 250],
                ['Aug 19', 360],
                ['Sep 19', 750],
                ['Oct 19', 200],
                ['Nov 19', 150],
                ['Dec 19', 90],
            ]);

            var view = new google.visualization.DataView(data);

            var options = {
                tooltip: {
                    isHtml: true
                },
                colors: ['#8d9bfc'],
                chartArea: {
                    left: 40,
                    top: 30,
                    width: '95%',
                    height: '76%'
                },
                bar: {
                    groupWidth: "20%"
                },
                legend: {
                    position: "none"
                },
                hAxis: {
                    slantedText: true,
                    slantedTextAngle: 45,
                    maxAlternation: 5,
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }

                },
                vAxis: {
                    baselineColor: '#aaa',
                    gridlines: {
                        color: '#eeeeee',
                        count: 7
                    },
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }
                }

            };
            var chart = new google.visualization.ColumnChart(document.getElementById("appointmentCreate"));
            chart.draw(view, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Month", "Booked", "Cancelled"],
                ['Jan 19', 900, 235],
                ['Feb 19', 700, 120],
                ['Mar 19', 800, 50],
                ['Apr 19', 600, 330],
                ['May 19', 100, 20],
                ['Jun 19', 200, 54],
                ['Jul 19', 200, 45],
                ['Aug 19', 900, 400],
                ['Sep 19', 890, 360],
                ['Oct 19', 200, 72],
                ['Nov 19', 200, 60],
                ['Dec 19', 200, 50],
            ]);

            var view = new google.visualization.DataView(data);

            var options = {
                tooltip: {
                    isHtml: true
                },
                colors: ['#3693d0', '#7dccfe'],
                chartArea: {
                    left: 40,
                    top: 30,
                    width: '95%',
                    height: '78%'
                },
                bar: {
                    groupWidth: "40%"
                },
                legend: {
                    position: "none"
                },
                hAxis: {
                    slantedText: false,
                    maxAlternation: 5,
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }

                },
                vAxis: {
                    baselineColor: '#aaa',
                    gridlines: {
                        color: '#eeeeee',
                        count: 7
                    },
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }
                }

            };
            var chart = new google.visualization.ColumnChart(document.getElementById("registeredDoc"));
            chart.draw(view, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Months', 'Issued', 'Dispensed'],
                ['Jan 19', 900, 400],
                ['Feb 19', 700, 200],
                ['Mar 19', 800, 100],
                ['Apr 19', 600, 150],
                ['May 19', 100, 650],
                ['Jun 19', 200, 950],
                ['Jul 19', 200, 950],
                ['Aug 19', 900, 950],
                ['Sep 19', 890, 950],
                ['Oct 19', 852, 950],
                ['Nov 19', 784, 950],
                ['Dec 19', 980, 450],

            ]);

            var options = {
                title: '',
                colors: ['#3593d0', '#7fcbfd'],
                chartArea: {
                    left: 40,
                    top: 30,
                    width: '95%',
                    height: '76%'
                },

                legend: {
                    position: "none"
                },
                hAxis: {
                    title: '',
                    slantedText: true,
                    slantedTextAngle: 45,
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

            var chart = new google.visualization.LineChart(document.getElementById('prescriptionCount'));
            chart.draw(data, options);
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Pharmacies", "Numbers"],
                ["Paracetamol", 66],
                ["Ativan", 47],
                ["Ibuprofen", 30],
                ["Zoloft", 88],
                ["Lorazepam", 47],
                ["Trazodone", 77],
                ["Ciprofloxacin", 17],
                ["Cymbalta", 47],
                ["Amoxicillin", 77],
                ["Codeine", 18]
            ]);

            var view = new google.visualization.DataView(data);

            var options = {
                tooltip: {
                    isHtml: true
                },
                colors: ['#855fa8'],
                chartArea: {
                    left: 40,
                    top: 30,
                    width: '95%',
                    height: '80%'
                },
                bar: {
                    groupWidth: "20%"
                },
                legend: {
                    position: "none"
                },
                hAxis: {
                    slantedText: false,
                    maxAlternation: 12,
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }

                },
                vAxis: {
                    baselineColor: '#aaa',
                    gridlines: {
                        color: '#eeeeee',
                        count: 7
                    },
                    textStyle: {
                        color: '#777',
                        fontSize: 11
                    }
                }

            };
            var chart = new google.visualization.ColumnChart(document.getElementById("pharmacieTop"));
            chart.draw(view, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Account Type', 'Distribution'],
                ['Ultrasound', 25],
                ['MRI', 20],
                ['EKG', 30],
                ['Thyroid Profile', 25],
                ['Blood Test', 25]


            ]);

            var options = {
                tooltip: {
                    isHtml: true
                },
                // pieHole: 0.6,
                colors: ['#5574ba', '#448bcb', '#8681bd', '#7ca7d9', '#8aa3e3'],
                pieSliceText: 'none',

                chartArea: {
                    width: '80%',
                    height: '80%'
                },
                legend: {
                    position: "none",
                    alignment: 'center',
                    textStyle: {
                        color: '#fff',
                        fontSize: 11
                    }
                },

            };

            var chart = new google.visualization.PieChart(document.getElementById('distributionAc'));

            chart.draw(data, options);
        }
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