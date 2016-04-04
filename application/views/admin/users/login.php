<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta name="keywords" content="" />
        <meta name="title" content="<" />
        <meta name="description" content="" />
        <meta name="author" content="">
        <meta name="uri-translation" content="on" />
        <title>Green Season Travels | Admin</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="<?php echo base_url('apple-touch-icon.png') ?>">

        <link rel="stylesheet" href="<?php echo base_url('public/css/main.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/css/admin.css') ?>">
<script src="<?php echo base_url('public/js/vendor/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('public/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

      
        <main role="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="page-content"  style="width:500px; margin:0 auto;">

<div class="well well-sm blog-center">
    <?php $attr_form = array('id' => 'login-form', 'class' => 'form', 'role' => 'form');  ?>
    <?php echo form_open('admin/users/login', $attr_form); ?>
    
    <div class="form-group">
        <p> <?php echo form_label('Email Address: ', 'email');  ?> 
        <?php echo form_input('email', set_value('email'), 'id="email" class="form-control" autofocus');  ?> </p>
    </div>
    <div class="form-group">
        <p> <?php echo form_label('Password: ', 'password');  ?> 
        <?php echo form_password('password', set_value('password'), 'id="login-password" class="form-control" autofocus');  ?> </p>
    </div>

   
    <?php echo form_submit('submit', 'Login', 'class="btn btn-default"'); ?>
    <?php if(validation_errors() != false){?>
    <div class="error-box round" style="margin-bottom: 0px !important; padding-top:30px; color: #F00 !important;  font-size: 15px;"> <?php echo validation_errors(); ?> </div>
    <?php }?>
    
    <br/>
   
</div>

<?php include_once('application/views/admin/footer.php'); ?>