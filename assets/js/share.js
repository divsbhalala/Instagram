$(window).ready(function (){
    
    $(document).on('click','.share',function (){
        var shareType=$(this).data('share');
        $('socialshare').text(shareType);
        $('shareon').text($(this).data('name'));
        var shareImage=$('#srcImg').attr('src');
        $('#shrImg').attr('src',shareImage);
        $('#shareModal').modal('show');
        return false;
        
       
    });
    
    $(document).on('click','#goforshare',function (){
         var shareType= $('socialshare').text();;
          var shareImage=$('#srcImg').attr('src');
          var stype=$('stype').text();
          
         $.ajax({
            type: 'POST',
            beforeSend: function (xhr) {
                 $('#shareModal').modal('hide');
                 $('#spinner-modal').modal('show');
            },
            url: "http://sociallabels.imnwebhosting.com/share.php",
            data:{
                "shareType":shareType,
                "shareImage":btoa(shareImage),
                'msg':$('#message-text').val(),
                'tag':$('#tag-name').val(),
                'posttype':stype
            },
            dataType: 'json',
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        }).done(function (data){
             $('#spinner-modal').modal('hide');
            console.log(data)
        });
    });
});