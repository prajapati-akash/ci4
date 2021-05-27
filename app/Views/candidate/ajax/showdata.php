<input type="hidden" class="csrfToken" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>">
<table class="table table-bordered  table-hover custom-style" width="100%">
  <thead>
    <tr align="center">
      <th scope="col" width="3%"> # </th>
      <th scope="col" width="22%"> Full Name </th>
      <th scope="col" width="7%"> Post </th>
      <th scope="col" width="20%"> Total Experience (In Years) </th>
      <th scope="col" width="10%"> Current CTC </th>
      <th scope="col" width="12%"> Expected CTC </th>
      <th scope="col" width="12%"> Status </th>
      <th scope="col" width="14%"> Action </th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($showdata['count'] > 0) :
      $offset = ($pager->getcurrentPage() - 1) * $pager->getperPage();
      $srno = $offset + 1;
    
      foreach ( $showdata['data'] as $key => $value) :
    ?>
    <tr style="text-align: -webkit-center">
      <th scope="row"> <?= $srno++ ?> </th>
      <td> <?= humanize($value['firstname']." ".$value['middlename']." ".$value['lastname']) ?> </td>
      <td> <?= $value['language'] ?> </td>
      <td> <?= $value['expirience'] ?> </td>
      <td> <?= number_to_currency($value['currentctc'], 'INR') ?> </td>
      <td> <?= number_to_currency($value['expectedctc'], 'INR') ?> </td>
      <td> <?= $value['currentstatus'] ?> </td>
      <td>
        <div class="row" style="margin-left: 10px">
          <div class="col-5">
            <form action="<?= base_url('candidate/edit') ?>" method="post" >
              <input type="hidden" name="id" value="<?= encode($value['id']) ?>">
              <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
              <button class="btn btn-outline-warning" type="submit"><i class="fa fa-user-edit"></i></button>
            </form>
          </div>
          <div class="col-5">
            <form action="<?= base_url('candidate/delete') ?>" method="post" onclick="return confirm('Are you sure you want to delete a candidate?');">
              <input type="hidden" name="id" value="<?= encode($value['id']) ?>">
              <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
              <button class="btn btn-outline-danger" type="submit"><i class="fa fa-trash"></i> </button>
            </form>
          </div>
        </div>
      </td>
    </tr>
    <?php
      endforeach;
    else:
    ?>
    <tr align="center">
      <td colspan="8" headers="Message" > No Record Found </td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>
<?= $pager->Links() ?>