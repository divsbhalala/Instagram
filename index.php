<?php
set_include_path(__DIR__);
$path = __DIR__;
require_once 'pages/include/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">
<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top hidden" role="navigation">
    <div class="container" >
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Social Share</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="http://sociallabels.imnwebhosting.com/wall/">Social Gallery</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container"  style="margin-top: 80px" >
    <button class="btn btn-info shareownimages">Share Your own</button>
    <!-- /.container -->


    <!-- Modal -->
   <div class="modal fade rise-modal" id="spread-word" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <div class="modal-content-wrapper tabscontainer">
                        
                        <div class="row" id="browsetab">
                            <div class="col-lg-12 ">
                                <a href="#" class="help-icon"><i class="fa fa-question-circle fa-2"></i></a>
                                <form class="dropzone" action="uploadphoto.php">

                                    <div class="mt-50 mb-50 text-center dz-default dz-message" data-dz-message>
                                        <p ><img src="assets/images/upload-img-icon.png" alt="Upload Image" width="130" height="131"></p>
                                        <h1 class="text-orange mt-30 large">DRAG &amp; DROP <span class="light text-blue">A PICTURE</span></h1>
                                        <p>OR</p>
                                        <a href="#" class="btn btn-primary">BROWSE DESKTOP FILES</a>
                                        <p class="small mt-10">Choose a files from desktop</p>
                                        <img src="assets/images/upload-a-photo.png" id="dropzone-click-target"class="upload-a-photo dz-clickable" alt="Upload a Photo" width="151" height="81">

                                    </div>

                                </form>
                            </div>
                        </div>
                        
                        <div class="row" id="allowcamera" style="display: none;">
                            <div class="col-lg-12 mn-access-camera  ">
                                <a href="#" class="help-icon"><i class="fa fa-question-circle fa-2"></i></a>
                                <div class="mt-50 mb-50 text-center">
                                    <i class="fa fa-camera fa-7x text-light-gray"></i>
                                    <h1 class="text-orange mt-30 large">PLEASE ALLOW ACCESS <br><span class="light text-blue">TO YOUR CAMERA</span></h1>
                                    <p>OR</p>
                                    <a href="#" class="btn btn-primary reqpermission">REQUEST PERMISSION</a>
                                </div>
                            </div>
                            <div class="col-md-12 text-center camdiv" style="display: none;">
                             <div class="camera" id="camera">
                                <div id="screen"></div>
                                <div id="buttons">
                                    <div class="buttonPane">
                                        <a id="shootButton" href="" class="blueButton">Shoot!</a>
                                    </div>
                                    <div class="buttonPane" style="display: none;">
                                        <a id="cancelButton" href="" class="blueButton">Cancel</a>
                                        <a id="uploadButton" href="" class="greenButton">Upload!</a>
                                    </div>
                                    <div class="buttonPane">
                                        <a id="" href="" class="blueButton settings">Setting</a>
                                    </div>
                                </div>


                            </div>
                            </div>
                        </div>
                        
                        <div class="row" id="facebooktabs" style="display: none;">
                            <div class="col-lg-12 fblogindiv ">
                                <a href="#" class="help-icon"><i class="fa fa-question-circle fa-2"></i></a>
                                <div class="mt-30 mb-50 text-center">
                                    <h1 class="text-orange large mb-20">UPLOAD A FILE FROM <span class="light text-facebook">FACEBOOK</span></h1>
                                    <i class="fa fa-facebook-square fa-7x text-facebook"></i>
                                    <p class="large text-facebook mt-20 mb-20">Get images from your Facebbok albums. <br>Don't worry we play nice..</p>
                                    <a href="#" class="btn btn-facebook btn-fb-login">CONNECT TO FACEBOOK</a>
                                    <p class="small mt-10">We will open a new page to connect to your Facebook <br>so you can authorise access to your photos</p>
                                </div>
                            </div>
                            <div class="col-md-12 fbphotosdiv" style="display: none">

                            </div>
                        </div>
                        
                        <div class="row" id="instagramstabs" style="display: none;">
                            <div class="col-lg-12 logininstadiv ">
                                <a href="#" class="help-icon"><i class="fa fa-question-circle fa-2"></i></a>
                                <div class="mt-30 mb-50 text-center">
                                    <h1 class="text-orange large mb-20">UPLOAD A FILE FROM <span class="light text-blue">INSTAGRAM</span></h1>
                                    <i class="fa fa-instagram fa-7x text-instagram"></i>
                                    <p class="large text-instagram mt-20 mb-20">Get images from your Instagram albums. <br>Don't worry we play nice.</p>
                                    <a href="pages/doinstalogin.php" target="_blank" class="instagrmtabbtn btn btn-instagram">CONNECT TO INSTAGRAM</a>
                                    <p class="small mt-10">We will open a new page to connect to your Instagram account <br>you will need to authrize access to your photos</p>
                                </div>
                            </div>
                            <div class="instaphotodiv col-md-12" style="display: none;">
                                
                                
                            </div>
                        </div>
                        <div class="row" id="flickrtabs" style="display: none;">
                            <div class="col-lg-12 loginflickrdiv">
                                <a href="#" class="help-icon"><i class="fa fa-question-circle fa-2"></i></a>
                                <div class="mt-30 mb-50 text-center">
                                    <h1 class="text-orange large mb-20">UPLOAD A FILE FROM <span class="light text-blue">FLICKR</span></h1>
                                    <i class="fa fa-flickr fa-7x text-flickr"></i>
                                    <p class="large text-flickr mt-20 mb-20">Get images from your Flickr albums. <br>Don't worry we play nice.</p>
                                    <a href="pages/flickrlogin.php" target="_blank" class="flickrtabbtn btn btn-flickr">CONNECT TO FLICKR</a>
                                    <p class="small mt-10">We will open a new page to connect to your Flickr account <br>you will need to authrize access to your photos</p>
                                </div>
                            </div>
                            <div class="col-lg-12 flickrphotodiv" style="display: none">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="tab-btn-wrapper text-center">
                        <ul class="list-inline text-center tab-btn-list">
                            <li class="desktop-tab active callmodel" idstr="browsetab"><i class="fa fa-desktop"></i></li>
                            <li class="camera-tab callmodel" idstr="allowcamera"><i class="fa fa-camera"></i></li>
                            <li class="facebook-tab callmodel" idstr="facebooktabs"><i class="fa fa-facebook-square"></i></li>
                            <li class="instagram-tab callmodel instagrmtabbtn" islogin="0" idstr="instagramstabs"><i class="fa fa-instagram"></i></li>
                            <li class="flickr-tab callmodel flickrtabbtn" islogin="0" idstr="flickrtabs"><i class="fa fa-flickr"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="notifications">

    </div>
</div>
</body>


<?php
require_once './pages/include/footer.php';
?>
<script src="assets/webcam/webcam.js"></script>
<script src="assets/webcam/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
<script src="assets/js/tabs.js"></script>
<script type="text/javascript">
    $(document).on('click', '.shareownimages', function () {
        $('#spread-word,.modal-content').modal('show');
    })
    $(document).on('click', '.reqpermission', function () {
        $('.mn-access-camera').hide();
        $('.camdiv').show();
    })

</script>

