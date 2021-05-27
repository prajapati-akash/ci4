<input type="hidden" class="csrfToken" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
<table class="table table-bordered table-hover custom-style" width="100%" >
  <thead>
    <tr align="center">
      <th scope="col"> # </th>
      <th scope="col"> Name </th>
      <th scope="col"> Email </th>
      <th scope="col"> Profile </th>
      <th scope="col"> Created at </th>
      <th scope="col"> Updated at </th>
      <th scope="col"> Status </th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($showdata['count'] > 0) :
        $offset = ($pager->getcurrentPage() - 1) * $pager->getperPage();
        $srno = $offset + 1;
        foreach ( $showdata['data'] as $key => $value) :
    ?>
    <tr align="center">
      <th style="text-align: center" scope="row"> <?= $srno++ ?> </th>
      <td> <?= $value['name'] ?> </td>
      <td> <?= $value['email'] ?> </td>
      <td> <img src="<?php if ($value['profile_image']){
        if (filter_var($value['profile_image'], FILTER_VALIDATE_URL))
        {
          echo $value['profile_image']; 
        } else {
          echo base_url('external/uploads/images/').'/'.$value['profile_image'];
        }
      } else {
          echo base_url('external/uploads/images/').'/myprofile.png'; 
      } ?>" width="70" height="70" > </td>
      <td> <?= date("d/m/Y H:i a", strtotime($value['created_at'])) ?> </td>
      <td> <?= date("d/m/Y H:i a", strtotime($value['updated_at'])) ?> </td>
      <td > 
        <form action="<?= base_url('admin/dashboard/status') ?>" method="post" onclick="return confirm('Are you sure you want to <?php if ($value['status'] == 0) { echo 'active'; } else { echo 'deactive'; } ?> a user ?')">
          <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
          <input type="hidden" name="id" class="id" value="<?= encode($value['id']) ?>">
          <input type="hidden" name="status" class="status" value="<?= encode($value['status']) ?>">
          <button type="submit" <?php if ($value['status'] == 0) { 
                echo 'class="btn btn-success statusForm" title="Active"';
            } else { 
             echo 'class="btn btn-danger statusForm" title="Deactive"';
            } 
            ?> > <?php if ($value['status'] == 1) { echo '<i class="fa fa-user fa-lg" aria-hidden="true"> </i> '; } else { echo '<i class="fa fa-user-slash" aria-hidden="true"></i>'; } ?>   </button>
        </form>       
      </td>
    </tr>
    <?php
      endforeach;
    else:
    ?>
    <tr align="center"> <td colspan="8" headers="Message" > No Record Found </td></tr>
    <?php endif; ?>
  </tbody>
</table>
  <?= $pager->Links() ?> </td>
  