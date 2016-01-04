<?php
$siteurl = 'http://sociallabels.imnwebhosting.com/';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Multipurpose Website UI Theme</title>
        <!--BOOTSTRAP CSS-->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="theme/jquery-ui/jquery-ui.css">
        <link rel="stylesheet" href="theme/image_tandoor.css">
        <link rel="stylesheet" href="css/styles.css">
        <!--THEME CSS-->
        <link rel="stylesheet" href="theme/theme.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body siteurl="<?php echo $siteurl; ?>">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </header>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
            </div>
        </footer>
        <!-- Modal -->
        <div class="modal fade rise-modal" id="spread-word" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-body">
                        <div class="modal-content-wrapper tabscontainer">
                            <a href="#" class="help-icon"><i class="fa fa-question-circle fa-2"></i></a>
                            <div id="modal-tab-content">
                                <!--DESKTOP TAB START-->
                                <div class="row tab-content show" id="desktop-tab">
                                    <div class="col-lg-12 ">
                                        <div class="mt-50 mb-50 text-center">
                                            <p><img src="images/upload-img-icon.png" alt="Upload Image" width="130" height="131"></p>
                                            <!--h1 class="text-orange mt-30 large">DRAG &amp; DROP <span class="light text-blue">A PICTURE</span></h1>
                                                            <p>OR</p-->
                                            <h1 class="text-orange mt-30 large text-uppercase">UPLOAD <span class="light text-blue">A FILE</span></h1>
                                            <p class="text-uppercase large mb-0">UPLOAD PHOTO FROM YOUR MACHINE</p>
                                            <a href="#" class="btn btn-primary" id="browse">BROWSE DESKTOP FILES</a>
                                            <p class="small mt-10">Choose a files from desktop</p>
                                            <!--img src="images/upload-a-photo.png" class="upload-a-photo" alt="Upload a Photo" width="151" height="81">
                                                            <img src="images/choose-additional.png" class="choose-additional" alt="Choose Additional Options" width="167" height="98"-->
                                        </div>
                                    </div>
                                </div>
                                <!--DESKTOP TAB END-->
                                <!--CAMERA TAB START-->
                                <div class="row tab-content  hide" id="camera-tab">
                                    <div class="col-lg-12 ">
                                        <div class="mt-50 mb-50 text-center">
                                            <i class="fa fa-camera fa-7x text-light-gray"></i>
                                            <h1 class="text-orange mt-30 large">PLEASE ALLOW ACCESS <br><span class="light text-blue">TO YOUR CAMERA</span></h1>
                                            <p>OR</p>
                                            <a href="#" class="btn btn-primary take-photo" id="request-permission">REQUEST PERMISSION</a>
                                        </div>
                                    </div>
                                </div>
                                <!--CAMERA TAB END-->
                                <!--TAKE PHOTO WITH CAMERA START-->
                                <div class="row tab-content  hide" id="take-photo">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="mt-10 mb-10 text-center">
                                            <div class="gray-place-holder"></div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="btn btn-primary  btn-block">MIRROR</button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn  btn-warning  btn-block" id="take-photo-btn">TAKE A PHOTO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--TAKE PHOTO WITH CAMERA END-->
                                <!--IMAGE CROP START-->
                                <div class="row tab-content  hide" id="image-crop">
                                    <div class="col-lg-12">
                                        <div class="mb-50 text-center">
                                            <div class="row">
                                                <div class="col-md-12" id="canvas-holder">
                                                    <div class="canvas-holder">
                                                        <canvas id="imageCanvas"></canvas>
                                                    </div>
                                                    <div class="row hide" id="sec-btns-holder">
                                                        <div class="col-md-6">
                                                            <a id="edit-image-preview" href="#" class="btn btn-primary btn-bordered">EDIT</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a id="download-image-preview" class="btn btn-primary btn-bordered">DOWNLOAD</a>
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <a id="email-image-preview" href="#" class="btn btn-primary btn-bordered">SEND EMAIL</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5 col-md-4 hide" id="tools-holder">
                                                    <!--button class="btn btn-primary btn-bordered btn-block mb-10 mt-20">VIEW ORIGINAL IMAGE</button>
                                                                            <button class="btn  btn-warning  btn-bordered btn-block mb-10">PREVIEW</button-->
                                                    <div class="btn-group-small text-left" id="tools">
                                                    </div>
                                                    <div id="subtool" class="text-left">
                                                    </div>
                                                    <!-- New Elements Starts-->
                                                    <!-- Select Color -->
                                                    <div class="text-left hide" id="select-color">
                                                        <h3>Select Two Color To Keep</h3>
                                                        <p>Click on the color you want to keep</p>
                                                        <div class="subtool-holder">
                                                            <div class="subtool-group">
                                                                <div class="add-cp-button cp-button-1">
                                                                    <div>&nbsp;</div>
                                                                </div>
                                                                <div class="add-cp-button cp-button-2">
                                                                    <div>&nbsp;</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Adjust -->
                                                    <div class="text-left hide" id="adjust-color">
                                                        <h3>Adjust Select Color</h3>
                                                        <p>Slide the bar left or right to adjust the color</p>
                                                        <p class="small">Note: You will be able to clean up the image by adding color to specific areas or removing color later. We suggest getting it as close as you can now but not worring if its perfect.</p>
                                                        <div class="subtool-holder">
                                                            <div class="subtool-block">
                                                                <div class="subtool-group">
                                                                    <div class="add-cp-button cp-button-1">
                                                                        <div id="cp-1">&nbsp;</div>
                                                                    </div>
                                                                    <div class="slider-holder tool-slider"></div>
                                                                    <a href="" class="remove-color-link"></a>
                                                                </div>
                                                            </div>
                                                            <div class="subtool-block">
                                                                <div class="subtool-group">
                                                                    <div class="add-cp-button cp-button-2">
                                                                        <div id="cp-2">&nbsp;</div>
                                                                    </div>
                                                                    <div class="slider-holder tool-slider"></div>
                                                                    <a href="" class="remove-color-link"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-left hide" id="touch-brush">
                                                        <h3>Touch Up Your Photo</h3>
                                                        <p>Use Either The Add Color or Remove Color Brush</p>
                                                        <ul class="icon-list list-unstyled">
                                                            <li class="saturated"><span class="icon"></span><span>The remove color brush will make areas black and white</span></li>
                                                            <li class="desaturated"><span class="icon"></span><span>The ass color brush will make selected areas the original color of the uploaded photo</span></li>
                                                        </ul>
                                                        <p class="small">Note You can change the size of the brush using the slider</p>
                                                        <div class="subtool-holder btn-group-small">
                                                            <label >Select A brush</label>
                                                            <div class="add_table_data_botton_class btn btn-primary btn-bordered  btn_desat" id="desat-btn"></div>
                                                            <div class="add_table_data_botton_class btn btn-primary btn-bordered btn_sat" id="sat-btn"></div>
                                                            <div class="slider-holder" id="slider-holder"></div>
                                                        </div>
                                                    </div>
                                                    <!-- Spreed Words -->
                                                    <div class="text-left hide" id="share-word">
                                                        <h3>Spread The Word</h3>
                                                        <p>Please allow access to your cameraPlease allow access to your cameraPlease allow access</p>
                                                        <div class="social-btns-holder"><a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Share on Twitter</a><a href="#" class="btn btn-instagram"><i class="fa fa-instagram"></i> Share on Instagram</a><a href="#" class="btn btn-flickr"><i class="fa fa-flickr"></i> Share on Flicker</a><a href="#" class="btn btn-facebook"><i class="fa fa-facebook-square"></i> Share on Facebook</a></div>
                                                    </div>
                                                    <!-- Email  Words -->
                                                    <div class="text-left hide" id="send-email">
                                                        <h3>Email</h3>
                                                        <p class="small">Enter Your Rmail Address</p>
                                                        <form action="" class="mb-20">
                                                            <input type="text" name="
                                                                   email" class="form-control">
                                                            <input id="send-email-preview" value="Email Me A Copy" class="btn btn-primary text-uppercase mt-10">
                                                        </form>
                                                        <p class="small">Note: If you don’t see the email please remember to check your junk or spam folder. Some Email services may send our emails there.</p>
                                                    </div>
                                                    <!-- Email Send Words -->
                                                    <div class="text-left hide" id="post-send">
                                                        <div class="text-left">
                                                            <div class="alert alert-success" role="alert">Your Email Has Been Sent</div>
                                                            <!-- <h3>Spread The Word</h3>
                                                            <p>Please allow access to your cameraPlease allow access to your cameraPlease allow access</p>
                                                            <div class="social-btns-holder"><a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Share on Twitter</a><a href="#" class="btn btn-instagram"><i class="fa fa-instagram"></i> Share on Instagram</a><a href="#" class="btn btn-flickr"><i class="fa fa-flickr"></i> Share on Flicker</a><a href="#" class="btn btn-facebook"><i class="fa fa-facebook-square"></i> Share on Facebook</a></div> -->
                                                        </div>
                                                    </div>
                                                    <!-- New Elements End -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--IMAGE CROP END-->
                                <!--IMAGE EDIT START-->
                                <div class="row tab-content  hide" id="color">
                                    <div class="col-lg-8">
                                        <div class="color-selector">
                                            <label>Select Colors To Keep</label>
                                            <div class="color-sq-box"></div>
                                            <div class="color-slider text-center"><img src="images/slider-img.png"></div>
                                            <div class="btn-group-inline">
                                                <button class="btn btn-default"><i class="fa fa-plus"></i></button>
                                                <button class="btn btn-default"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="preview-block"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button class="btn btn-primary btn-bordered btn-block mb-10 mt-50">VIEW ORIGINAL IMAGE</button>
                                        <button class="btn  btn-warning  btn-bordered btn-block mb-10">REVIEW</button>
                                        <div class="btn-group-small">
                                            <button class="btn btn-primary btn-bordered paintbrush active"><i class="fa fa-paint-brush"></i></button>
                                            <button class="btn btn-primary btn-bordered paintbrush2"><i class="fa fa-paint-brush"></i></button>
                                            <button class="btn btn-primary btn-bordered zoom"><i class="fa fa-search-plus"></i></button>
                                            <button class="btn btn-primary btn-bordered undo"><i class="fa fa-undo"></i></button>
                                            <button class="btn btn-primary btn-bordered redo"><i class="fa fa-repeat"></i></button>
                                        </div>
                                        <div class="option-block">
                                            <div id="paintbrush" class="options show text-center"><img src="images/slider-img.png"></div>
                                            <div id="paintbrush2" class="options hide text-center">Some options</div>
                                            <div id="zoom" class="options hide text-center">zoom options</div>
                                        </div>
                                    </div>
                                </div>
                                <!--IMAGE EDIT END-->
                                <!--IMAGE SHARE START-->
                                <div class="row tab-content  hide" id="share">
                                    <div class="col-lg-8">
                                        <form>
                                            <div class="form-group">
                                                <textarea name="" id="" cols="30" rows="15" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <button class="btn btn-primary btn-bordered btn-block">EDIT</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button class="btn  btn-warning  btn-bordered btn-block">DOWNLOAD</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <h1 class="text-orange mt-30">SPREAD THE <span class="light text-blue">WORD</span></h1>
                                        <p class="text-center">Please allow access to your cameraPlease allow access to your cameraPlease allow access</p>
                                        <div class="social-btns-holder">
                                            <a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Share on Twitter</a>
                                            <a href="#" class="btn btn-instagram"><i class="fa fa-instagram"></i> Share on Instagram</a>
                                            <a href="#" class="btn btn-flickr"><i class="fa fa-flickr"></i> Share on Flicker</a>
                                            <a href="#" class="btn btn-facebook"><i class="fa fa-facebook-square"></i> Share on Facebook</a>
                                        </div>
                                    </div>
                                </div>
                                <!--IMAGE SHARE END-->
                                <!--FACEBOOK TAB START-->
                                <div class="row tab-content  hide" id="facebook-tab">
                                    <div class="col-lg-12 fblogindiv ">
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
                                <!--FACEBOOK TAB END-->
                                <!--INSTAGRAM TAB START-->
                                <div class="row tab-content  hide" id="instagram-tab">
                                    <div class="col-lg-12 logininstadiv ">
                                        <a href="#" class="help-icon"><i class="fa fa-question-circle fa-2"></i></a>
                                        <div class="mt-30 mb-50 text-center">
                                            <h1 class="text-orange large mb-20">UPLOAD A FILE FROM <span class="light text-blue">INSTAGRAM</span></h1>
                                            <i class="fa fa-instagram fa-7x text-instagram"></i>
                                            <p class="large text-instagram mt-20 mb-20">Get images from your Instagram albums. <br>Don't worry we play nice.</p>
                                            <a href="<?php echo $siteurl ?>pages/doinstalogin.php" target="_blank" class="btn btn-instagram">CONNECT TO INSTAGRAM</a>
                                            <p class="small mt-10">We will open a new page to connect to your Instagram account <br>you will need to authrize access to your photos</p>
                                        </div>
                                    </div>
                                    <div class="instaphotodiv col-md-12" style="display: none;">


                                    </div>
                                </div>
                                <!--INSTAGRAM TAB END-->
                                <!--FLICKR TAB START-->
                                <div class="row tab-content  hide" id="flickr-tab">
                                    <div class="col-lg-12 ">
                                        <div class="mt-30 mb-50 text-center">
                                            <h1 class="text-orange large mb-20">UPLOAD A FILE FROM <span class="light text-blue">FLICKR</span></h1>
                                            <i class="fa fa-flickr fa-7x text-flickr"></i>
                                            <p class="large text-flickr mt-20 mb-20">Get images from your Flickr albums. <br>Don't worry we play nice.</p>
                                            <a href="#" class="btn btn-flickr">CONNECT TO FLICKR</a>
                                            <p class="small mt-10">We will open a new page to connect to your Flickr account <br>you will need to authrize access to your photos</p>
                                        </div>
                                    </div>
                                </div>
                                <!--FLICKR TAB END-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="tab-btn-wrapper text-center show" id="tab-btn-wrapper">
                            <ul class="list-inline text-center tab-btn-list">
                                <li class="desktop-tab active " idstr="browsetab"><i class="fa fa-desktop"></i></li>
                                <li class="camera-tab " idstr="allowcamera"><i class="fa fa-camera"></i></li>
                                <li class="facebook-tab " idstr="facebooktabs"><i class="fa fa-facebook-square"></i></li>
                                <li class="instagram-tab  instagrmtabbtn" islogin="0" idstr="instagramstabs"><i class="fa fa-instagram"></i></li>
                                <li class="flickr-tab  flickrtabbtn" islogin="0" idstr="flickrtabs"><i class="fa fa-flickr"></i></li>
                            </ul>
                        </div>
                        <div class="btn-wrapper hide" id="link-btn">
                            <a href="index.php" class="btn btn-link btn-link-warning">go back to image upload</a>
                            <a href="#" class="btn btn-primary" id="continue">CONTINUE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/modal.js"></script>
        <script type="text/javascript" src="bootstrap/js/tab.js"></script>
        <script type="text/javascript" src="theme/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/image_tandoor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

        <script type="text/javascript">
            $(window).load(function () {
                $('#spread-word').modal('show');
            });

            // Initialize
            $(document).on('click', '.instagrmtabbtn', function () {

                $('#instagram-tab').removeClass('hide');
            })
            $(document).on('click', '.flickrtabbtn', function () {

                $('#flickr-tab').removeClass('hide');
            })

            imageTandoor.init();


            navigator.getMedia = (navigator.getUserMedia ||
                    navigator.webkitGetUserMedia ||
                    navigator.mozGetUserMedia ||
                    navigator.msGetUserMedia);

            var currentWindow = "take-photo",
                    cameraWidth = 320, // **** camera width
                    cameraHeight,
                    localMediaStream;


            function loadCamera() {
                var video = document.getElementById('photo-take-video'),
                        jqVideo = $(video).attr({
                    width: cameraWidth
                }),
                        jqCanvas = $('#photo-take-canvas');
                $("#camera-tab").addClass('hide').removeClass('show');
                $("#take-photo").removeClass('hide');
                $('#edit-taken-photo-btn').hide();
                $('#take-photo-btn').show();
                $('#camera-mirror').show();
                $('#camera-retake').hide();
                jqCanvas.hide();
                jqVideo.show();



                navigator.getMedia({
                    video: true,
                    audio: false
                },
                function (stream) {
                    localMediaStream = stream;
                    if (navigator.mozGetUserMedia) {
                        video.mozSrcObject = stream;
                    } else {
                        var vendorURL = window.URL || window.webkitURL;
                        video.src = vendorURL.createObjectURL(stream);
                    }
                    video.play();
                },
                        function (err) {
                            console.log("An error occured! " + err);
                        }
                );


            }


            function takeImage() {
                var video = document.getElementById('photo-take-video'),
                        jqVideo = $(video),
                        canvasElem = document.getElementById('photo-take-canvas'),
                        context = canvasElem.getContext('2d'),
                        jqCanvas = $(canvasElem);

                cameraHeight = video.videoHeight / (video.videoWidth / cameraWidth);

                if (isNaN(cameraHeight)) {
                    cameraHeight = cameraWidth / (4 / 3);
                }
                jqCanvas.attr({
                    width: cameraWidth,
                    height: cameraHeight
                })

                context.drawImage(video, 0, 0, cameraWidth, cameraHeight)
                video.pause();
                localMediaStream && localMediaStream.stop && localMediaStream.stop();

                $('#edit-taken-photo-btn').show();
                $('#take-photo-btn').hide();
                $('#camera-mirror').hide();
                $('#camera-retake').show();
                jqCanvas.show();
                jqVideo.hide();

            }

            function applymirror() {

            }


            function hideAll() {

                $('#select-color').addClass('hide');
                $('#adjust-color').addClass('hide');
                $('#touch-brush').addClass('hide');
                $('#share-word').addClass('hide');
                $('#sec-btns-holder').addClass('hide');
                $('#send-email').addClass('hide');
                $('#post-send').addClass('hide');
            }


            function showCropOption() {
                hideAll();
                $("#image-crop").siblings().removeClass("show").addClass("hide");
                $("#image-crop").addClass("show");
                $("#tab-btn-wrapper").removeClass("show").addClass("hide");
                $("#link-btn").addClass("show");
                $("#canvas-holder").addClass("col-sm-12");
                currentWindow = "image-crop";
            }

            function activeColorPicker() {
                hideAll();
                $('#select-color').removeClass("hide");
                $('#adjust-color').removeClass("hide");
                $("#tools-holder").removeClass("hide");
                $("#canvas-holder").addClass("col-sm-7 col-md-8").removeClass("col-md-12");
                currentWindow = "color-picker";
                imageTandoor.activateColourPicker();
            }

            function activeTouchUp() {
                hideAll();
                currentWindow = "touch-up";
                $('#touch-brush').removeClass("hide");
                imageTandoor.activateBrush();

            }

            function preview() {
                hideAll();
                $('#share-word').removeClass("hide");
                $('#sec-btns-holder').removeClass("hide");
                currentWindow = "preview";
                imageTandoor.preview();
            }

            function email() {
                $('#send-email').removeClass("hide");
                $('#share-word').addClass("hide");
            }

            function sendEmail() {
                $('#send-email').addClass("hide");
                $('#post-send').removeClass('hide');
                $('#share-word').removeClass('hide');
            }



            function showAdvanceEditOption() {
                //$("#color").siblings().removeClass("show").addClass("hide");
                //$("#color").addClass("show");
                //$("#tab-btn-wrapper").removeClass("show").addClass("hide");
                //$("#link-btn").addClass("show");
                imageTandoor.deActivateTool();
                $("#tools-holder").removeClass("hide");
                $("#canvas-holder").addClass("col-sm-7 col-md-8").removeClass("col-md-12");
                currentWindow = "color";

            }


            function showShareOption() {
                //helper.deActivateTool();
                // $("#share").siblings().removeClass("show").addClass("hide");
                // $("#share").addClass("show");
                // $("#tab-btn-wrapper").removeClass("show").addClass("hide");
                // $("#link-btn").addClass("show");
                $("#canvas-holder").append(extraBtns);
                $("#tools-holder").html(shareBtns);
                $("#continue").remove();
            }
            function getloadimg(imgsrc) {
                showCropOption();
                // @temp
                imageTandoor.loadImage(imgsrc, 'url');
            }

            $(document).ready(function () {



                //email-image-preview

                $('#email-image-preview').on('click', email);
                $('#send-email-preview').on('click', sendEmail);
                $('#edit-image-preview').on('click', activeColorPicker);
                $('#download-image-preview').on('click', function () {
                    imageTandoor.downLoad(this.id)
                });

                $("#continue").on("click", function () {
                    /*var getSection = $("#modal-tab-content .show").attr("id");
                     console.log(getSection);*/

                    switch (currentWindow) {
                        case "take-photo":
                            showCropOption();
                            break;
                        case "image-crop":
                            activeColorPicker();
                            break;
                        case "color-picker":
                            activeTouchUp();
                            break;
                        case "touch-up":
                            preview();
                            break;
                        case "preview":
                            //preview();
                            break;
                    }
                });




                /// Camera upload feature
                $('#camera-snap').on('click', loadCamera);
                $('#take-photo-btn').on('click', takeImage);
                $('#edit-taken-photo-btn').on('click', function () {
                    var canvasElem = document.getElementById('photo-take-canvas'),
                            context = canvasElem.getContext('2d');

                    showCropOption();
                    imageTandoor.loadImage(context.getImageData(0, 0, cameraWidth, cameraHeight), 'imagedata');
                });
                $('#camera-mirror').on('click', applymirror);
                $('#camera-retake').on('click', loadCamera);












                $('#tab-btn-wrapper li').click(function (e) {
                    e.preventDefault();
                    if ($(this).hasClass("active")) {
                        //console.log("hi");
                    } else {
                        var clickedTab = $(this).attr("class");
                        $("#modal-tab-content").find(".tab-content").removeClass("show").addClass("hide");
                        $("#modal-tab-content").find("#" + clickedTab).addClass("show");
                        $(this).siblings().removeClass("active");
                        $(this).addClass("active");
                    }
                });

                $("#request-permission").on("click", function () {
                    $("#take-photo").siblings().removeClass("show").addClass("hide");
                    $("#take-photo").addClass("show");
                    $("#tab-btn-wrapper").removeClass("show").addClass("hide");
                    $("#link-btn").addClass("show");
                });



                $("#browse").on("click", function () {
                    showCropOption();
                    // @temp
                    imageTandoor.loadImage('images/test-images/chear.jpg', 'url');
                });



                var extraBtns = "<div class='row'>";
                extraBtns += "<div class='col-sm-6'>";
                extraBtns += "<button class='btn btn-primary btn-bordered btn-block'>EDIT</button>";
                extraBtns += "</div>";
                extraBtns += "<div class='col-sm-6'>";
                extraBtns += "<button class='btn  btn-warning  btn-bordered btn-block'>DOWNLOAD</button>";
                extraBtns += "</div>";
                extraBtns += "</div>";

                var shareBtns = "<h1 class='text-orange mt-30'>SPREAD THE <span class='light text-blue'>WORD</span></h1>";
                shareBtns += "<p class='text-center'>Please allow access to your cameraPlease allow access to your cameraPlease allow access</p>";
                shareBtns += "<div class='social-btns-holder'>";
                shareBtns += "<a href='#' class='btn btn-twitter'><i class='fa fa-twitter'></i> Share on Twitter</a>";
                shareBtns += "<a href='#' class='btn btn-instagram'><i class='fa fa-instagram'></i> Share on Instagram</a>";
                shareBtns += "<a href='#' class='btn btn-flickr'><i class='fa fa-flickr'></i> Share on Flicker</a>";
                shareBtns += "<a href='#' class='btn btn-facebook'><i class='fa fa-facebook-square'></i> Share on Facebook</a>";
                shareBtns += "</div>";








                $(".paintbrush").on("click", function () {
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");
                    $("#paintbrush").removeClass("hide").addClass("show");
                    $("#paintbrush").siblings().removeClass("show").addClass("hide");
                });

                $(".paintbrush2").on("click", function () {
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");
                    $("#paintbrush2").removeClass("hide").addClass("show");
                    $("#paintbrush2").siblings().removeClass("show").addClass("hide");
                });

                $(".zoom").on("click", function () {
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");
                    $("#zoom").removeClass("hide").addClass("show");
                    $("#zoom").siblings().removeClass("show").addClass("hide");
                });


                // Check Active

                $(".add_table_data_botton_class").on("click", function () {
                    $("#slider-holder").addClass("active-slider");
                })


            });
        </script>
        <script src="js/tabs.js"></script>
    </body>

</html>