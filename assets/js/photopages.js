$(document).ready(function (){
    var h=$(window).height()/2;
    console.log(h);
    $('.part1,.part2').css('height',h);
    $('.part1,.part2').css('background','#000');
});
$(window).ready(function(){
    $('.part1').slideUp(800);
    $('.part2').slideToggle(800);
    $('.pg-photos').delay(900).fadeIn(100);
    if (Modernizr.touch) {
        // show the close overlay button
        $(".close-overlay").removeClass("hidden");
        // handle the adding of hover class when clicked
        $(".img").click(function(e){
            if (!$(this).hasClass("hover")) {
                $(this).addClass("hover");
            }
        });
        // handle the closing of the overlay
        $(".close-overlay").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            if ($(this).closest(".img").hasClass("hover")) {
                $(this).closest(".img").removeClass("hover");
            }
        });
    } else {
        // handle the mouseenter functionality
        $(".img").mouseenter(function(){
            $(this).addClass("hover");
        })
        // handle the mouseleave functionality
        .mouseleave(function(){
            $(this).removeClass("hover");
        });
    }
});