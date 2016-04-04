<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
       <title>Green Season - Admin</title> 
    <!-- Stylesheets -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo base_url('public/css/jquery-ui.css') ?>">
	
    <link rel="stylesheet" href="<?php echo base_url('public/css/main.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/admin.css') ?>"><script src="<?php echo base_url('public/js/plugin.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/tinymce4.1/tinymce.min.js"></script>
    <script src="<?php echo base_url('public/js/admin.js')?>"></script>

    <script type="text/javascript">

        tinymce.init({
            selector: "textarea",
            theme: "modern",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });

    </script>

</head>
<body>

    <!-- TOP BAR -->
    <?php include_once('application/views/admin/menu.php'); ?>
    <!-- HEADER -->

    <main role="main">
        <div class="container-fluid">
            <div class="row">
                <div class="page-content">