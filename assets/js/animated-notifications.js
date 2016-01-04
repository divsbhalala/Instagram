$(window).load(function () {



    function resize() {
        $('#notifications').height(window.innerHeight - 50);
    }
    $(window).resize(function () {
       // resize();
    });
    //resize();


    function refresh_close() {
        $('.close').click(function () {
            $(this).parent().fadeOut(200);
        });
    }
    refresh_close();




    var top = '<div id="notifications-top-center"><span class="iconb" data-icon="&#xe20e;"></span> Oups something went wrong !<div id="notifications-top-center-close" class="close"><span class="iconb" data-icon="&#xe20e;"></span></div></div>';

    var center = '<div id="notifications-full">\n\
<div id="notifications-full-close" class="close">\n\
<span class="iconb" data-icon="&#xe20e;"></span>\n\
</div><div id="notifications-full-icon">\n\
<span class="iconb icon-checkmark text-success" "></span>\n\
</div><div id="notifications-full-text">\n\
This is a large notification. You can use this notification to display long warnings. This type of notification is not suited for short warnings. As an added bonus you have a big icon at the top.\n\
</div></div>';

    var bottom = '<div id="notifications-bottom-center-tab"><div id="notifications-bottom-center-tab-close" class="close"><span class="iconb" data-icon="&#xe20e;"></span></div><div id="notifications-bottom-center-tab-avatar"><img src="_assets/avatar.png" width="100" height="100" /></div><div id="notifications-bottom-center-tab-right"><div id="notifications-bottom-center-tab-right-title"><span>George</span> sent you a message</div><div id="notifications-bottom-center-tab-right-text">This is a sample notification that <br> will appear centered in the bottom .</div></div></div>';

    var bottom_center = '<div id="notifications-bottom-right-tab"><div id="notifications-bottom-right-tab-close" class="close"><span class="iconb" data-icon="&#xe20e;"></span></div><div id="notifications-bottom-right-tab-avatar"><img src="_assets/avatar.png" width="70" height="70" /></div><div id="notifications-bottom-right-tab-right"><div id="notifications-bottom-right-tab-right-title"><span>George</span> sent you a message</div><div id="notifications-bottom-right-tab-right-text">This is a sample notification that <br> will appear the right bottom corner.</div></div></div>';





    function cllpopup() {

        $("#notifications-full").remove();
        $("#notifications").append(center);
        $("#notifications-full").addClass('animated zoomIn');
        refresh_close();
    }
   // cllpopup();

    $('#notifications-window-row-button').click(function () {



        if ($('#position').val() == 'top') {

            $("#notifications-top-center").remove();
            $("#notifications").append(top);
            $("#notifications-top-center").addClass('animated ' + $('#effects').val());
            refresh_close();

        }
        if ($('#position').val() == 'center') {

            $("#notifications-full").remove();
            $("#notifications").append(center);
            $("#notifications-full").addClass('animated zoomIn');
            refresh_close();

        }
        if ($('#position').val() == 'bottom') {

            $("#notifications-bottom-center").html();
            $("#notifications-bottom-center").html(bottom);
            $("#notifications-bottom-center-tab").addClass('animated ' + $('#effects').val());
            refresh_close();

        }
        if ($('#position').val() == 'botom_right') {

            $("#notifications-bottom-right").html();
            $("#notifications-bottom-right").html(bottom_center);
            $("#notifications-bottom-right-tab").addClass('animated ' + $('#effects').val());
            refresh_close();

        }




    });



});