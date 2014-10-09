<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>fulbito</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/configuracion/bootstrap.min.css">
 
  <!--<link rel="stylesheet" href="<?php /*echo base_url();*/?>/assets/css/bootstrap-responsive.min.css">-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/configuracion/configuracion.css">

</head>
<body>
		
    <div class="navbar">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="brand" href="<?php echo base_url() ?>index.php/home" name="top">fulbito</a>
          <ul class="nav">
            <!--<li><a href="<?php echo base_url() ?>index.php/home"><i class="icon-home"></i> Home </a></li>-->
            <li><a href="<?=$_SERVER["HTTP_REFERER"]?>"> Atras </a></li>
            
            <li class="divider-vertical"></li>
            <li class="userInfo"><strong><?php echo $this->session->userdata('mail'); ?> </strong></li>
          </ul>
            
          
      </div>
      <!--/.container-fluid -->
    </div>
    <!--/.navbar-inner -->
    </div>
