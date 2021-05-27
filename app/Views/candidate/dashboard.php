<br>
<div class="container " >
	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-4 ">
					<!-- csrf token -->
					<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?php if(isset($token)) {echo $token; } echo csrf_hash(); ?>" />
					
					<!-- language or post dropdown -->
					<select name='language'  id="selectlan" class="language form-select">
						<option value="" class="dropdown-item">All post data</option>
						<option value="java" class="dropdown-item"> java </option>
						<option value="android" class="dropdown-item"> android </option>
						<option value="php" class="dropdown-item"> php </option>
						<!-- load in this ajax fetch data -->
					</select>
				</div>
				<div class="col-sm-4">
					<!--  status dropdown -->
					<select name="currentstatus" id="selectstatus" class="currentstatus form-select">
						<option value="">All status data</option>
						<option value="Hired"> Hired </option>
						<option value="Reviewed"> Reviewed </option>
						<option value="Rejected"> Rejected </option>
						<!-- load in this ajax fetch data -->
					</select>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="d-flex justify-content-end" >
				<a href="<?php echo base_url("candidate/add"); ?>" title="Add Candidate" class="btn btn-dark" ><i class="fas fa-user-plus fa-lg"></i>  </a>
			</div>
		</div>
	</div>
	<input type="hidden" class="csrfdata csrfToken" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>">
	<!-- load dashboard data -->
	<div id="table_data" class="row">
	</div>
</div>