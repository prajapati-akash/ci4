<div class="container">
	<div class="row">
		<h1> Log In</h1>
		<?= form_open("/login"); ?>
		<div class="row mb-3">
			<label for="inputEmail3" class="col-sm-2 col-form-label"> Email <em> * </em></label>
			
			<div class="col-sm-4">
				<input type="text" name="email" class="form-control" id="inputEmail3" value="<?= set_value('email') ?>">
			</div>
			
			<div class="container col-sm-5">
				<span class="text-danger"> <?= display_error($validation, "email") ?></span>
			</div>
		</div>
		<div class="row mb-3">
			<label for="inputPassword3" class="col-sm-2 col-form-label"> Password <em> * </em> </label>
			<div class="col-sm-4">
				<input type="password" name="password" class="form-control" id="inputPassword3">
			</div>
			<div class="container col-sm-5 ">
				<span class="text-danger">
					<?= display_error($validation, "password") ?>
				</span>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-md-4">
				<button type="submit" class="btn btn-primary">Log In</button>
				Not registed?<a class="link-primary" href="<?= base_url('/registration');?>" title="Registere First"> Create an account </a>
			</div>
		</div>
		
		
		<div class="col-md-4">
			<?php
			if (isset($login_button))
			{
			?>
			<a href="<?= $login_button ?>" title=""><img src="<?= base_url('/external/images/google_signin.png') ?>" width="200px" alt="Login WIth Google"></a>
			<?php
			} ?>
			
		</div>
		<?= form_close() ?>
	</div>
</div>