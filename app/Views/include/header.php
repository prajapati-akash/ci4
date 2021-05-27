<!DOCTYPE html>
<html>
  <head>
    <title> <?php if(isset($title)) echo $title; ?> </title>
    <?php
    echo link_tag('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css');
    echo link_tag('external/css/style.css');
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <?php
    if(session()->has('admin_id') && isset($admin))
    {
    ?>
    <nav class="navbar navbar-expand-md navbar-dark " style="background-color: #211E55;">
      <div class="container-fluid">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link fw-bold" href="<?= base_url('admin/dashboard'); ?>"><i class="fas fa-home fa-3x"></i></a>
            </li>
          </ul>
        </div>
        <div class="mx-auto order-0">
          <h1 class="navbar-brand mx-auto logo-font"> Interview System </h1>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 font-color">
          <ul class="navbar-nav ms-auto" >
            <div class="collapse navbar-collapse" id="main_nav">
              <li class="nav-item dropdown">
                <a class="nav-link  dropdown fw-bold " href="#" data-toggle="dropdown btn-color"> <b><h4> Welcome &nbsp;<?= session()->get('admin_name') ?> </h4> </b> </a>
                <ul class="dropdown-menu">
                  <li> <a href="<?= base_url('admin/logout') ?>" title="Logout" class="btn dropdown-item btn btn-warning  btn-color"> Logout </a> </li>
                </ul>
              </li>
            </div>
          </ul>
        </div>
      </div>
    </nav>
    <?php
    }
    else if(session()->has('user_id') && isset($user))
    {
    ?>
    <nav class="navbar navbar-expand-md navbar-dark " style="background-color: #004E7C;">
      <div class="container-fluid">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link fw-bold" href="<?= base_url('/dashboard'); ?>"><i class="fa fa-home fa-3x"></i></a>
            </li>
          </ul>
        </div>
        <div class="mx-auto order-0">
          <h1 class="navbar-brand mx-auto logo-font"> Interview System </h1>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2 font-color">
          <ul class="navbar-nav ms-auto" >
            <div class="collapse navbar-collapse" id="main_nav">
              <li class="nav-item dropdown">
                <a class="nav-link  dropdown fw-bold " href="#" data-toggle="dropdown btn-color"> <b><h4> Welcome <?= session()->get('user_name') ?></h4></b>  </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item btn btn-warning btn-color " title="My Profile" href="<?= base_url('candidate/profile') ?>"> My Profile</a></li>
                  <li> <a href="<?= base_url('/logout') ?>" title="Logout" class="btn dropdown-item btn btn-warning  btn-color"> Logout </a> </li>
                </ul>
              </li>
            </div>
          </ul>
        </div>
      </div>
    </nav>
    <?php
    }
    else
    {
    ?>
    <nav class="navbar navbar-expand-md navbar-dark " style="background-color: #004E7C;">
      <div class="container-fluid">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link font-weight-bold" href="<?= base_url(); ?>">Home</a>
            </li>
          </ul>
        </div>
        <div class="mx-auto order-0">
          <h1>
          <a class="navbar-brand mx-auto logo-font" href="<?= base_url('/login') ?>">Interview System</a>
          </h1>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">        
        </div>
      </div>
    </nav>
    <?php
    }

if (session()->getTempdata('message') || session()->getTempdata('error_message')): ?>
<div class="alert <?php echo session()->getTempdata('message')?'alert-success':''; 
            echo session()->getTempdata('error_message')?'alert-danger':''; ?> alert-dismissible fade show" role="alert">
  <strong> <?php  echo session()->getTempdata('message');
                  echo session()->getTempdata('error_message'); ?> </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>