<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="abhishek@devzone.co.in">

        <title>Social Share Admin</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
         <link href="<?php echo SITE_URL; ?>assets/css/bootstrap-social.css" rel="stylesheet">

        
        <link rel="stylesheet" href="<?php echo HTTP_ASSETS_PATH_ADMIN; ?>font-awesome/css/font-awesome.css" />
        <!-- Add custom CSS here -->
        <link href="<?php echo HTTP_CSS_PATH; ?>arkadmin.css" rel="stylesheet">
        <!-- JavaScript -->
        <script src="<?php echo HTTP_JS_PATH; ?>jquery-1.10.2.js"></script>
        <script src="<?php echo HTTP_JS_PATH; ?>bootstrap.js"></script>
        <script src="<?php echo HTTP_JS_PATH; ?>das.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
          <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
        <![endif]-->
        <!--  
    
    Author : Abhishek R. Kaushik 
    Downloaded from http://devzone.co.in
        -->

    </head>

    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>admin">Social Admin Penal </a>
                </div>
                <?php
// Define a default Page
                $pg = isset($page) && $page != '' ? $page : 'dash';
                ?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li <?php echo $pg == 'dash' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li <?php echo $pg == 'user' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>users"><i class="fa fa-user"></i> Users</a></li>
                        <li <?php echo $pg == 'post' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>socialpost"><i class="fa fa-file"></i> All Post</a></li>
                        <li <?php echo $pg == 'fbpost' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>socialpost/facebook"><i class="fa fa-facebook"></i> Facebook Post</a></li>
                        <li <?php echo $pg == 'twitterpost' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>socialpost/twitter"><i class="fa fa-twitter"></i> Twitter Post</a></li>
                        <li <?php echo $pg == 'flickrpost' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>socialpost/flickr"><i class="fa fa-flickr"></i> Flickr Post</a></li>
                        <li ><a href="<?php echo base_url(); ?>logout/"><i class="fa fa-user"></i> Signout</a></li>


                    </ul>

                  
                </div><!-- /.navbar-collapse -->
            </nav>
