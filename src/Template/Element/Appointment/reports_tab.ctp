<div class="tabingcolender reportstab">
	<div class="searchBox calenderwith calender">
		<input type="text" id="reportCalender" placeholder="Search by doctor name">
		<button><b class="sprite clderIcon cld_icon clderIconClick"></b></button>
	</div>
	<!--<span class="btn btn-secondary" data-toggle="modal" data-target="#uploadreports-modal"> UPLOAD</span>-->
</div>
<div class="reportswrap-table">
	<div class="tablewrap ">
		<table id="reportsTable" style="width:100%">
			<thead>
				<tr>
					<th>Test name</th>
					<th>Date Of Test</th>
					<th>Notes</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="reportsData">
			<?php
			if(isset($allReportsData) && !empty($allReportsData)) {
			foreach(array_values($allReportsData) as $pKey => $pValue) {
			if($pValue["test_recommended"]==0) { ?>
				<tr>
					<td><?php echo isset($pValue["test_name"]) ? $pValue["test_name"] : ""; ?></td>
					<td><span class="reportsdate dateData"><?php echo isset($pValue["test_date"]) ? $pValue["test_date"] : ""; ?></span></td>
					<td><span class="commientsWrap"><?php echo isset($pValue["test_notes"]) ? $pValue["test_notes"] : ""; ?></span></td>
					<td class="text-right">
						<div class="usermoreOpction reportstd-width">
							<a href="<?php echo !empty($pValue["test_report_filename"]) ? PATH.'img/images/prescription/'.$pValue["test_report_filename"] : "#"; ?>" class="colorBrown" <?php echo !empty($pValue["test_report_filename"]) ? "download" : ""; ?> >Download</a>
							<a href="<?php echo !empty($pValue["test_report_filename"]) ? PATH.'img/images/prescription/'.$pValue["test_report_filename"] : "#"; ?>" class="colorBrown" <?php echo !empty($pValue["test_report_filename"]) ? "target='_blank'" : ""; ?>>VIEW</a>
						</div>
					</td>
				</tr>
			<?php } } } ?>
			</tbody>
		</table>
	</div>
	<!--<div class="loadmore reportmore"><span>LOAD MORE</span>
		<br>
	</div>-->
</div>