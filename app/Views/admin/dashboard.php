<input type="hidden" class="csrfToken" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
<div class="container">
	<!-- load table data using ajax -->
	<div id="admin_table_data" class="row"></div>
</div>