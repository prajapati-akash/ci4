<h1 align="center"><?= $title ?></h1>
<div class="container">
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8 ">
			<form action="" method="post" >
				<div class="row mb-3" >
					<label for="inputEmail3" class="col-sm-2 col-form-label">Email <em class="required">* </em></label>
					<div class="col-sm-6">
						<input type="text" name="email" class="form-control" id="inputEmail3" value="<?= set_value('email') ?>">
						<input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
					</div>
					<br>
					<div class="col-sm-4">
						<span class="text-danger"> <?= display_error($validation, "email") ?></span>
					</div>
				</div>
				<div class="row mb-3">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Password <em class="required"> * </em></label>
					<div class="col-sm-6 ">
						<input type="password" name="password" class="form-control" id="inputPassword3">
					</div>
					<div class="col-sm-4 ">
						<span class="text-danger"> <?= display_error($validation, "password") ?></span>
					</div>
				</div>
				<div class="text-center">
					<button type="submit" class="col-sm-2 btn btn-info justify-center">Log In</button>
				</div>
			</form>
		</div>
	</div>
</div>