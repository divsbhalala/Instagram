<?php
set_include_path(__DIR__);
$path = __DIR__;
session_set_cookie_params(1800);
session_start();
if (!isset($_SESSION['user'])) {
    header('location:index.php');
}
require_once 'pages/include/header.php';
if (isset($_SESSION['twitter'])) {
    $ti = 'share';
    $turl = 'javascript:void(0);';
} else {
    $ti = '';
    $turl = 'tlogin.php';
}
$socialBtn = '<a class="btn btn-social-icon btn-lg btn-facebook share toolTip " data-name="Facebook" data-share="fb" title="Share this Photo On Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a class="btn btn-social-icon btn-lg btn-instagram share toolTip" data-name="Instagram" data-share="insta" title="Share this Photo On Instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a class="btn btn-social-icon btn-lg btn-flickr share toolTip" data-name="Flickr" data-share="flickr" title="Share this Photos on Flickr">
                        <i class="fa fa-flickr"></i>
                    </a>
                    <a class="btn btn-social-icon btn-lg btn-twitter  toolTip ' . $ti . '" data-name="Twitter" data-share="twitter" href="/pages/' . $turl . '" data-share="twitter" title="Share this Photos on Flickr">
                        <i class="fa fa-twitter"></i>
                    </a>';
?>
<body class="" >

    <div class="part1"></div>
    <div class="part2"></div>
    <div class="container pg-photos"style="display: none">
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
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container " style="margin-top: 80px;" >

            <div class="row">


                <div id="effect-1" class="effects clearfix">
                    <div class="img img-responsive col-md-6">
                        <img src="photos/<?php echo $_GET['file'] . '.' . $_SESSION['ext'] ?>" id="srcImg"> 
                        <div class="overlay text-center">
                            <div class="btn-social-bottom">
                                <?php echo $socialBtn ?>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="social-share-btn col-md-6 text-center ">
                    <?php echo $socialBtn ?>
                </div>

            </div>
            <div class="modal fade" id="spinner-modal">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h3><i class="fa fa-cog fa-spin"></i> Please wait while Posting Photos ...</h3>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Share On <shareon></shareon> </h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="form-group box">
                                            <img src="" id="shrImg">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">HashTag:</label>
                                            <input type="text" class="form-control" value="RISEtoWIN" id="tag-name">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Message:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                    </div>
                                    <socialshare class="hidden"></socialshare>
                                    <stype class="hidden">POST</stype>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="goforshare">Share</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; <?php echo date('Y'); ?></p>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.container -->
    </div>

</body>


<?php
require_once './pages/include/footer.php';
?>
<script src="assets/js/photopages.js"></script>
<script src="assets/js/share.js"></script>
<script>

</script>
