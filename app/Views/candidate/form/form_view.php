<div class="container col-md-6">
  <h1 align="center"><?php if (isset($title)) echo $title; ?></h1>
  <?php
  if(isset($result))
  {
    echo form_open('candidate/update');
  }
  else
  {
    echo form_open();
  }
  ?>
  <div class="row">
    <div class="form-group col-md-4">
      <label for="firstname"> First Name <em class="required"> * </em> </label>
      <input type="hidden" name="id" value="<?php if (isset($result['id'])) echo $result['id']; ?>">
      
      <input type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash() ?>" />
      
      <input type="text" name="firstname" value="<?php
      if (isset($result['firstname']))
      {
        echo $result['firstname'];
      }
        echo set_value('firstname');
      ?>"
      class="form-control col-md-4">
      <span class="text-danger"> <?= display_error($validation, "firstname") ?></span>
    </div>
    <br>
    <div class="form-group-3 col-md-4">
      <label for="middlename"> Middle Name <em class="required"> * </em> </label>
      <input type="text" name="middlename" value="<?php
      if (isset($result['middlename']))
      {
        echo $result['middlename'];
      }
        echo set_value('middlename');
      ?>" class="form-control">
      <span class="text-danger"> <?= display_error($validation, "middlename") ?></span>
    </div>
    <br>
    <div class="form-group col-md-4">
      <label for="lastname"> Last Name <em class="required"> * </em> </label>
      <input type="text" name="lastname" value="<?php
      if(isset($result['lastname']))
      {
        echo $result['lastname'];
      }
        echo set_value('lastname');
      ?>" class="form-control">
      <span class="text-danger"> <?= display_error($validation, "lastname") ?></span>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="form-group col-md-4">
      <label for="education"> Education <em class="required"> * </em> </label>
      <select class="form-select" name="education" id="education">
        <option value="">Select Education</option>
        <?php
        $array = array("B.e.","M.c.a.","B.c.a.","B.tech.");
        foreach ($array as $value)
        {
        ?>
        <option value="<?= $value ?>" <?php if (isset($result['education']) && $result['education'] == "$value") echo "selected"; echo set_select('education', $value); ?> ><?= $value ?></option>
        <?php } ?>
      </select>
      <span class="text-danger"> <?= display_error($validation, "education") ?></span>
    </div>
    <br>
    <div class="form-group col-md-4">
      <label for="language">Apply For <em class="required"> * </em> </label>
      <select class="form-select" name="language" id="language">
        <option value="" >Select post</option>
        <?php
        $array = array("php","java","android");
        foreach ($array as $value)
        {
        ?>
        <option value="<?= $value ?>" <?php if (isset($result['language']) && $result['language'] == "$value") echo "selected"; echo set_select('language', $value); ?> ><?= $value ?> </option>
        <?php } ?>
      </select>
      <span class="text-danger"> <?= display_error($validation, "language") ?></span>
    </div>
    <div class="form-group col-md-4">
      <label for="expirience"> Total Expirience in year <em class="required"> * </em> </label>
      <input type="text" name="expirience" value="<?php
      if(isset($result['expirience']))
      {
        echo $result['expirience'];
      }
        echo set_value('expirience');
      ?>" class="form-control">
      <span class="text-danger"> <?= display_error($validation, "expirience") ?></span>
    </div>
    <br>
  </div>
  <br>
  <div class="row">
    <div class="form-group col-md-4">
      <label for="currentctc"> Current CTC <em class="required"> * </em> </label>
      <input type="text" name="currentctc" value="<?php
      if(isset($result['currentctc']))
      {
        echo $result['currentctc'];
      }
        echo set_value('currentctc');
      ?>" placeholder="" class="form-control col-md-4">
      <span class="text-danger"> <?= display_error($validation, "currentctc") ?></span>
    </div>
    <br>
    <div class="form-group col-md-4">
      <label for="expectedctc"> Expected CTC <em class="required"> * </em> </label>
      <input type="text" name="expectedctc" value="<?php
      if(isset($result['expectedctc']))
      {
        echo $result['expectedctc'];
      }
        echo set_value('expectedctc');
      ?>" placeholder="" class="form-control col-md-4">
      <span class="text-danger"> <?= display_error($validation, "expectedctc") ?></span>
    </div>
    <br>
    <div class="form-group col-md-4">
      <label for="noticeperiod"> Notice Period in month <em class="required"> * </em> </label>
      <input type="text" name="noticeperiod" value="<?php
      if (isset($result['noticeperiod']))
      {
        echo $result['noticeperiod'];
      }
        echo set_value('noticeperiod');
      ?>" class="form-control col-md-4">
      <span class="text-danger"> <?= display_error($validation, "noticeperiod") ?></span>
    </div>
  </div>
  <br>
  <div class="row">
    
    <div class="form-group col-md-4">
      <label for="interviewdate"> Interview Date Schedule <em class="required"> * </em> </label>
      <input type="date" name="interviewdate" value="<?php
      if (isset($result['interviewdate']))
      {
        echo $result['interviewdate'];
      }
        echo set_value('interviewdate');
      ?>" class="form-control"
      min="<?= date("Y-m-d") ?>" max="<?php $date=date_create(date("Y-m-d"));
      date_modify($date,"+1 month");
      echo date_format($date,"Y-m-d");  ?>" >
      <span class="text-danger"> <?= display_error($validation, "interviewdate") ?></span>
    </div>
  </div>
  <br>
  <div class="form-group col-md-12">
    <label for="reasontoleavejob"> Reason to Leave Job <em class="required"> * </em> </label>
    <textarea class="form-control" name="reason" id="reasontoleavejob" rows="3"><?= set_value('reason') ?><?php
    if (isset($result['reasonleavejob']))
    {
      echo $result['reasonleavejob'];
    }
      echo set_value('reasonleavejob');
    ?></textarea>
    <span class="text-danger"> <?= display_error($validation, "reason") ?></span>
  </div>
  <div class="form-group ">
    <p><label for="reasontoleavejob">Select status <em class="required"> * </em> </label> </p>
    <?php $stat = array("Reviewed","Hired","Rejected");
    $i=1;
    foreach ($stat as $value)
    {
    ?>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="status" id="selectstatus<?= $i ?>" value="<?= $value ?>"
      <?php
      if (isset($result['currentstatus']) && $result['currentstatus'] == "$value")
      echo "checked";  echo set_radio('status', $value); ?> >
      <label class="form-check-label" for="selectstatus<?= $i ?>"><?= $value ?> </label>
    </div>
    <?php $i++; } ?>
  </div>
  <span class="text-danger"> <?= display_error($validation, "status") ?></span>
  <br>
  <br>
  <div class="form-group" id="reject" style="
    <?php
    if (set_radio('status','Rejected') ||  (isset($result['currentstatus']) && $result['currentstatus'] == "Rejected"))
    {
      echo "";
    }
    else
    {
      echo "display: none";
    }
    ?>" >
    <label for="exampleTextareareason">  Reason For Rejected <em class="required"> * </em> </label>
    <textarea  id="rejected" class="form-control" name="rejectreason" rows="3" ><?= set_value('rejectreason') ?><?php
    if(isset($result['rejectedreason']))
    {
      echo $result['rejectedreason'];
    }
      echo set_value('rejectreason');
    ?></textarea>
    <span class="text-danger"> <?= display_error($validation, "rejectreason") ?></span>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary" title="Cancel"> Cancel </a>
</form>
</div>