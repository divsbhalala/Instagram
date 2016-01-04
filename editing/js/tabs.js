Dropzone.options.myAwesomeDropzone = {
    autoDiscover: false,
    maxFiles: 1,
    maxfilesexceeded: function (file) {
        this.removeFile(file);
    },
    acceptedFiles: "image/*",
    thumbnailWidth: 250,
    thumbnailHeight: 250,
    clickable: false,
    // clickable : '#dropzone-click-target',
    queuecomplete: function (progress) {
        alert('done');
    },
    init: function () {
        this.on("addedfile", function (file) {

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='btn btn-danger'>Remove file</button>");


            // Capture the Dropzone instance as closure.
            var _this = this;

            // Listen to the click event
            removeButton.addEventListener("click", function (e) {
                // Make sure the button click doesn't submit the form:
                e.preventDefault();
                e.stopPropagation();

                // Remove the file preview.
                _this.removeFile(file);
                // If you want to the delete the file on the server as well,
                // you can do the AJAX request here.
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);
        });
    }

};

var siteurl=$('body').attr('siteurl');
$(window).load(function () {
    $('#spread-word').modal('show');
    $(document).on('click', '.callmodel', function () {
        var divtid = $(this).attr('idstr');
        $('.callmodel').removeClass('active');
        $(this).addClass('active');
        $('.tabscontainer div.row').hide();
        $('#' + divtid).show();
    });
});
$(document).on('click', '.rprequest', function () {
    $('.rps').hide();
    $('.camera').show();
});


var fbAuthResp;
var album_single = '';
var userid = '';
var fb_user_info = '';
var fbphotos = new Array();
var stIndexFb = 0;
var fbbtn = false;
var mycnt = 0;
if ($('body').data('fboffset'))
{
    stIndexFb = $('body').data('fboffset');
}
var fblimit = 100;
var stIndexFb = 0;
var fbPhotos = new Array();

$(document).ready(function () {
    $('.tabscontainer').css('height', $(window).height() - 180);
    $('.tabscontainer').css('overflow-y', 'auto');
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    // $scope.init=function(){console.log('here')};
    var fbAuthResp;
    window.fbAsyncInit = function () {
        FB.init({
            appId: '485247754943027',
            cookie: true, // enable cookies to allow the server to access
            // the session
            xfbml: true, // parse social plugins on this page
            version: 'v2.2' // use version 2.1
        });

        FB.getLoginStatus(function (response) {

            if (response.status === 'connected') {


                fbUserInfo(response);

            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                // $('#fbstyle').show();
                //$('#fbstylelog').hide();
                console.log('Please log into this app.');
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                // $('#fbstyle').hide();
                //$('#fbstylelog').show();
                console.log('Please log into facebook.');
            }
        });

    };
    var fbUserInfo = function (response)
    {
        if (response.authResponse) {
            fbAuthResp = response;
            //Set Accesstoken of user in session
            $.ajax({
                url: siteurl+'/pages/fbstatus.php',
                type: 'post',
                data: {
                    'fb_accesstoken': response.authResponse.accessToken
                },
                success: function (data) {
                    // console.log(data);

                }
            }).done(function () {
                if (fbbtn === true)
                {
                    // window.location.reload();
                }
                $('.fblogindiv').hide();
                // $('.gallery-cont').show();

                getFbUserProfile(fbAuthResp);

            });
            // alert(response.authResponse.accessToken);


        }

    }
    var getFbUserProfile = function (response) {
        FB.api('/me', function (response) {
            console.log(response);
            getFbAlbum(response);
        });
    }
    var getFbAlbum = function () {

        FB.api('/me/photos/?limit=' + fblimit + '&offset=' + stIndexFb, function (response) {
            console.log(response);
            var photos = response.data;
            for (var i = 0; i < photos.length; i++)
            {
                var dd = {
                    'from': photos[i].from.name,
                    'source': photos[i].source,
                    'url': photos[i].images[1].source,
                    'height': '',
                    'width': '',
                    'id': photos[i].id
                };
                fbphotos.push(dd);
            }
            fbPhotos = response;
            setTimeout(function () {

                showmedia();

            }, 100);
        })
        stIndexFb += 20;

    }
    function fbLogout() {
        FB.logout(function (response) {
            $.ajax({
                url: siteurl+'pages/fbstatus.php',
                type: 'post',
                data: {
                    'removedir': userid
                },
                success: function (data) {
                    window.location.replace('index.php');
                    //  $('.btn-fb-logout').hide();

                }

            });


        });
    }
    function fbLogin() {

        fbbtn = true;
        FB.login(function (response) {
            fbUserInfo(response);
        }, {scope: 'email,user_photos,user_friends,publish_actions,user_friends,user_status,user_photos,manage_pages'})
    }
    $(document).on('click', '.btn-fb-logout', function () {
        fbLogout();
    })
    // var str='';
    function showmedia() {
        $('.fbphotosdiv').show();
        for (var i = 0; i < fbphotos.length; i++)
        {
            var str = '';
            str = ' <div class="col-lg-3 col-md-4 col-xs-6 box ">' +
                    '<div class="lab">' +
                    '</div>' +
                    '<a class="thumbnail getImg " title="Click me to See more"  data-imgsrc="' + fbphotos[i].source + '">' +
                    '<img class="img-responsive" src=' + fbphotos[i].url + ' alt="">' +
                    '</a>' +
                    '</div>';
            $('.fbphotosdiv').append(str);

            // simple_tooltip(".toolTip", "tooltip");
        }
        $('.fbphotosdiv').show();
        // window.sr = new scrollReveal();
    }
    $(document).on('click', '.getalb', function () {
        getFbAlbum();
    });
    $(document).on('click', '.btn-fb-login', function () {
        fbLogin();
    });

    simple_tooltip(".toolTip", "tooltip");
    if ($('flickr').text() !== '' || $('insta').text() !== '' || $('fb').text() !== '')
    {
        console.log('here')
        $('.loaderPhotos').hide();
        $('.gallery-cont').show();
    }


    function getflickrphotos() {
        $.get(siteurl+"pages/getflickrphotos.php", function (data) {
            console.log(data);
            if (data.length > 0)
            {
                $('.flickrtabbtn').attr('islogin', '1');
                $('.flickrphotodiv').empty();
                for (var i = 0; i < data.length; i++)
                {
                    var str = '';
                    str = ' <div class="col-lg-3 col-md-4 col-xs-6 box ">' +
                            '<div class="lab">' +
                            '</div>' +
                            '<a class="thumbnail getImg " title="Click me to See more"  data-imgsrc="' + data[i].url + '">' +
                            '<img class="img-responsive" src=' + data[i].url + ' alt="">' +
                            '</a>' +
                            '</div>';
                    $('.flickrphotodiv').append(str);

                    // simple_tooltip(".toolTip", "tooltip");
                }
                $('.loginflickrdiv').hide();
                $('.flickrphotodiv').show();


            }
        }, 'json');
    }
    function getinstagramphotos() {
        $.get(siteurl+"pages/getinstagramphotos.php", function (data) {
            console.log(data);
            if (data.hasOwnProperty('data'))
            {
                var photodata=data.data;
                $('.instaphotodiv').empty();
                 for (var i = 0; i < photodata.length; i++)
                {
                    $('.instagrmtabbtn').attr('islogin', '1');
                    if(!photodata[i].hasOwnProperty('images'))
                    {
                        return false;
                    }
                    var str = '';
                    str = ' <div class="col-lg-3 col-md-4 col-xs-6 box ">' +
                            '<div class="lab">' +
                            '</div>' +
                            '<a class="thumbnail getImg " title="Click me to See more"  data-imgsrc="' + photodata[i].images.standard_resolution.url + '">' +
                            '<img class="img-responsive" src=' + photodata[i].images.thumbnail.url + ' alt="">' +
                            '</a>' +
                            '</div>';
                    $('.instaphotodiv').append(str);

                    // simple_tooltip(".toolTip", "tooltip");
                }
                $('.logininstadiv').hide();
                $('.instaphotodiv').show();

            }

        }, 'json');
    }
    $(document).on('click', '.instagrmtabbtn', function () {
        getinstagramphotos();
        setInterval(function () {
            $login = $('.instagrmtabbtn').attr('islogin');
            if ($login == 0)
            {
                getinstagramphotos();
            }
        }, 1000);


    });
    $(document).on('click', '.flickrtabbtn', function () {
        getflickrphotos();
        setInterval(function () {
            $login = $('.flickrtabbtn').attr('islogin');
            if ($login == 0)
            {
                getflickrphotos();
            }
        }, 1000)

    });
     $(document).on('click', '.getImg', function (e) {
        e.preventDefault();
        var imgsrc = $(this).data('imgsrc');
        $.ajax({
            type: 'POST',
            data: 'url=' + btoa(imgsrc),
            url: siteurl+'/pages/getPhotosFromUrl.php',
            success: function (s) {
                console.log(s);
                if (s !== '' || s !== 'false')
                {
                    console.log('here');
                    getloadimg(siteurl+'photos/'+s+'.jpeg');
                   // window.location.replace('photos.php?file=' + s);
                }
            }, error: function (s, ss, er) {
                console.log(er)
            }
        })
    });

/*------------------Ayan code---------------------*/



});


/*--------------------------------TOOL TIP---------------------------------------------*/
function simple_tooltip(target_items, name) {
    $(target_items).each(function (i) {
        $("body").append("<div class='" + name + "' id='" + name + i + "'><p>" + $(this).attr('title') + "</p></div>");
        var my_tooltip = $("#" + name + i);

        if ($(this).attr("title") !== "") { // checks if there is a title

            $(this).removeAttr("title").mouseover(function () {
                my_tooltip.css({opacity: 0.8, display: "none"}).fadeIn(400);
            }).mousemove(function (kmouse) {
                my_tooltip.css({left: kmouse.pageX + 15, top: kmouse.pageY + 15});
            }).mouseout(function () {
                my_tooltip.fadeOut(400);

            });

        }
    });
}
$(document).on('hover', '.toolTip', function () {
    // simple_tooltip(".toolTip", "tooltip");
});

var w = $(window).width();
if (w <= 601)
{
    $('.dropzone').css('height', $(window).height() - 200)
}
/*--------------------------------END TOOL TIP---------------------------------------------*/


   