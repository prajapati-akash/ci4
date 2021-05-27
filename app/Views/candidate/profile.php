<input type="hidden" class="csrfdata csrfToken" name="<?=csrf_token() ?>" value="<?= csrf_hash() ?>">
<div class="container">
	<div class="row">
		<h2 align="center"> My profile </h2>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="col-md-6">
				<img src="<?php
				if($result['profile_image'] == NULL)
				{
					echo base_url('/external/uploads/images/myprofile.png');
				}
				else
				{
					if (filter_var($result['profile_image'], FILTER_VALIDATE_URL))
					{
						echo $result['profile_image'];
					}
					else
					{
						echo base_url('external/uploads/images').'/'.$result['profile_image'];
					}
				}
				?>" alt="profile_image" id="profileimage" height="150px" width="125px">
				<br><br>
				
				<input type="file" name="profileimg" id="imgInp" class="form-control" >
				<span class="text-danger"><?= display_error($validation, 'profileimg') ?></span>
			</div>
			<br>
			<div class="col-md-6">
				<table class="table table-borderless" >
					<tr>
						<td> Name : </td>
						<td >
							<input type="text" name="name" value="<?php echo $result['name'] ?>" class="form-control">
							<input type="hidden" name="id" value="<?php if(isset($result['id'])) echo $result['id']; ?>">
							<span class="text-danger"> <?= display_error($validation, 'name') ?> </span>
						</td>
					</tr>
					<tr>
						<td> Email : </td>
						<td> <input type="text" name="email" value="<?php if(set_value('email')) {  echo set_value('email'); } else { echo $result['email']; }  ?>" class="form-control">
						<span class="text-danger"> <?= display_error($validation, 'email') ?> </span>
					</td>
					</tr>
					<tr>
						<td colspan="2"> <input type="submit" name="submit" value="Submit" class="btn btn-primary">
						</td>
					</tr>
				</table>
			</div>
		</form>
	</div>
</div>