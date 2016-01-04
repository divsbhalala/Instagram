<?php
require_once './header.php';
$btnlogin='';
$container='';
$img='';
$img1='';
if(!isset($_SESSION['fb']))
{
    $container='display:none;';
   
}
else{
   $btnlogin='display:none;';
   $_SESSION['ext']='jpeg';
    $img= base64_decode($_REQUEST['img']);
 $name=  rand(111111111, 999999999);
 copy($img, '../photos/'.$name.'.'.$_SESSION['ext']);
  $img='../photos/'.$name.'.'.$_SESSION['ext'];
  $img1='photos/'.$name.'.'.$_SESSION['ext'];
}
if(!isset($_REQUEST['img'])){
    echo'<script>window.close();</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Social Share</title>

        <!-- Bootstrap Core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/font-awesome.css" rel="stylesheet">
        <link href="../assets/css/bootstrap-social.css" rel="stylesheet">
        <link href="../assets/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" type="text/css" media="screen" />
        <!-- Custom CSS -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery -->
        <style>
            .shr .btn{
                width: 100px;
            }
            
        </style>


    </head>
    <body class="" >
        <div class="part1"></div>
        <div class="part2"></div>
        <div class="container">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container" >
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">Social Share</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#">About</a>
                            </li>
                            <li>
                                <a href="#" onclick="window.close();">Close</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>

            <!-- Page Content -->
            <div class="container " style="margin-top: 80px; " >
                <div class="row"style="<?php echo $container; ?>">
                    <div class="col-md-12">


                        <div class="col-md-4 col-sm-4 ">
                            <div class="img-box text-center img-responsive">
                                <img  src="<?php echo $img; ?>">
                            </div>

                        </div>
                        <div class="col-md-7 col-sm-7">
                            <div class="form-group">
                                <label for="title-name" class="control-label">Title:</label>
                                <input type="text" class="form-control" id="title-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">HashTag:</label>
                                <input type="text" class="form-control" id="tag-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                            <div class="form-group text-center shr">
                                <button type="button" class="btn btn-default " data-dismiss="modal" onclick="window.close();">Close</button>
                                <button type="button" class="btn btn-primary " id="goforshare">Share <i class="fa fa-share-alt"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="row" style="<?php echo $btnlogin; ?>">
                    <div class="col-md-12 text-center">
                        <button  class="btn-fb-login btn btn-social btn-facebook" ><i class="fa fa-facebook"></i> Login With Facebook</button>
                    </div>
                    
                </div>
                <socialshare class="hidden">facebook</socialshare>
                <stype class="hidden">WALL</stype>

                <div class="modal fade" id="spinner-modal">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h3><i class="fa fa-cog fa-spin"></i> Please wait while Posting Photos ...</h3>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Footer -->
                <hr>
                <footer>
                    <div class="row" >
                        <div class="col-lg-12">
                            <p>Copyright &copy; <?php echo date('Y'); ?></p>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- /.container -->
        </div>
        <span class="hidden" id="srcImg" src="<?php echo $img1; ?>"></span>

    </body>

    <script src="../assets/js/jquery.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js" type="text/javascript"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/scrollReveal.js"></script>
    <script src="../assets/js/share.js"></script>
    <script src="../assets/js/fbscript.js"></script>
    <script>
                                    $(function () {
                                        $(".fancyboxIframe").fancybox({
                                            maxWidth: 900,
                                            maxHeight: 600,
                                            fitToView: false,
                                            width: '90%',
                                            height: '90%',
                                            autoSize: false,
                                            closeClick: false,
                                            openEffect: 'none',
                                            closeEffect: 'none',
                                            iframe: {
                                                scrolling: 'auto',
                                                preload: true
                                            }
                                        });
                                    });
    </script>


</html>
