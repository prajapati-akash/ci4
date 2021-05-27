<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1> Create Account</h1>
			<?= form_open(); ?>
			<div class="row mb-4 ">
				<label for="inputName3" class="col-sm-2 col-form-label"> Name <em> * </em> </label>
				<div class="col-sm-4">
					<input type="name" name="name" class="form-control" id="inputName3" value = "<?= set_value('name') ?>">
				</div>
				
				<div class="container col-sm-5">
					<span class="text-danger"> <?= display_error($validation, "name") ?></span>
				</div>
			</div>
			<div class="row mb-3">
				<label for="inputEmail3" class="col-sm-2 col-form-label"> Email <em>* </em></label>
				
				<div class="col-sm-4">
					<input type="text" name="email" class="form-control" id="inputEmail3" value="<?= set_value('email') ?>">
				</div>
				<div class="container col-sm-5">
					<span class="text-danger"> <?= display_error($validation, "email") ?></span>
				</div>
			</div>
			
			<div class="row mb-3">
				<label for="inputPassword3" class="col-sm-2 col-form-label"> Password <em> * </em></label>
				<div class="col-sm-4">
					<input type="password" name="password" class="form-control" id="inputPassword3">
				</div>
				<div class="container col-sm-5 ">
					<span class="text-danger"> <?= display_error($validation, "password") ?></span>
				</div>
			</div>
			
			<div class="row mb-3">
				<label for="inputConfirmPassword3" class="col-sm-2 col-form-label">Confirm password  <em> * </em></label>
				<div class="col-sm-4">
					<input type="password" name="confirm_password" class="form-control" id="inputConfirmPassword3">
				</div>
				
				<div class="container col-sm-5 ">
					<span class="text-danger"> <?= display_error($validation, "confirm_password") ?></span>
				</div>
			</div>
			
			<button type="submit" class="btn btn-primary">Sign in</button>&nbsp;&nbsp; &nbsp;&nbsp;
			If already register Then &nbsp;<a class="link-primary" href="<?= base_url();?>" title="Log In"> Log In</a>
			<?= form_close() ?>
		</div>
		
	</div>
</div>