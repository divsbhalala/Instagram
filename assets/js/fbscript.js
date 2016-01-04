
var fbAuthResp;
var album_single = '';
var userid = '';
var fb_user_info = '';
var fbphotos = new Array();
var stIndexFb = 0;
var fbbtn=false;
var mycnt=0;
if ($('body').data('fboffset'))
{
    stIndexFb = $('body').data('fboffset');
}
var fblimit = 20;
;
if ($('body').data('fblimit')) {
    fblimit = $('body').data('fblimit');
}
var fbPhotos = new Array();
$(document).ready(function () {

  /*  (function (d, s, id) {
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
                url: '/pages/fbstatus.php',
                type: 'post',
                data: {
                    'fb_accesstoken': response.authResponse.accessToken
                },
                success: function (data) {
                    console.log(data);
                    if ($('body').data('isfbcall'))
                    {
                        //$('.fbphotos').slideUp(400);
                        $('.fbphotos,.loadmorebtn,.getalb').show(400);
                        $('body').attr('data-isfbcall','Y');
                       // window.sr = new scrollReveal();
                    }
                }
            }).done(function () {
                if(fbbtn===true)
                {
                    window.location.reload();
                }
                $('.btn-fb-login').hide();
                $('.btn-fb-logout').show();
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
        if ($('body').data('isfbcall'))
        {
            if ($('body').data('isfbcall') === 'Y')
            {


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
                        $('.getalb').show();
                        $('.loaderPhotos').hide();
                        $('.fbphotos').show();
                        showmedia();

                    }, 100);
                })
                stIndexFb += 20;
            }
            else {
                $('body').data('isfbcall', 'Y');
            }
        }
    }
    function fbLogout() {
        FB.logout(function (response) {
            $.ajax({
                url: '/pages/fbstatus.php',
                type: 'post',
                data: {
                    'removedir': userid
                },
                success: function (data) {
                    window.location.replace('index.php');
                    $('.btn-fb-logout').hide();

                }

            });


        });
    }
    function fbLogin() {
        
        fbbtn=true;
        FB.login(function (response) {
            fbUserInfo(response);
        }, {scope: 'email,user_photos,user_friends,publish_actions,user_friends,user_status,user_photos,manage_pages'})
    }
    $(document).on('click','.btn-fb-logout',function (){
        fbLogout();
    })
    // var str='';
    function showmedia() {
        for (var i = 0; i < fbphotos.length; i++)
        {
            var str = '';
            str = ' <div class="col-lg-3 col-md-4 col-xs-6 box " data-sr="enter bottom,  over 1s" >' +
                    '<div class="lab">' +
                    '<span class="label label-info">'
                    + fbphotos[i].from +
                    '</span>' +
                    '</div>' +
                    '<a class="thumbnail getImg toolTip" title="Click me to See more" href="photos.php" data-imgsrc="' + fbphotos[i].source + '">' +
                    '<img class="img-responsive" src=' + fbphotos[i].url + ' alt="">' +
                    '</a>' +
                    '</div>';
           // $('.fbphotos').append(str);
            
           // simple_tooltip(".toolTip", "tooltip");
        }
        $('.fbphotos').show();
       // window.sr = new scrollReveal();
    }
    $(document).on('click', '.getalb', function () {
        getFbAlbum();
    });
    $(document).on('click','.btn-fb-login',function (){
        fbLogin();
    });
*/

    $(document).on('click', '.getImg', function (e) {
        e.preventDefault();
        var imgsrc = $(this).data('imgsrc');
        $.ajax({
            type: 'POST',
            data: 'url=' + btoa(imgsrc),
            url: '/pages/getPhotosFromUrl.php',
            success: function (s) {
                console.log(s);
                if (s !== '' || s !== 'false')
                {
                    console.log('here');
                    window.location.replace('photos.php?file=' + s);
                }
            }, error: function (s, ss, er) {
                console.log(er)
            }
        })
    });
    simple_tooltip(".toolTip", "tooltip");
    if($('flickr').text()!=='' || $('insta').text()!==''|| $('fb').text()!=='')
    {
        console.log('here')
        $('.loaderPhotos').hide();
        $('.gallery-cont').show();
    }
window.sr = new scrollReveal();

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

var w=$(window).width();
if(w<=601)
{
    $('.dropzone').css('height',$(window).height()-200)
}
/*--------------------------------END TOOL TIP---------------------------------------------*/
