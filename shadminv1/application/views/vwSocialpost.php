<?php
$this->load->view('vwHeader');
?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1> Post To Social Media </h1>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-12 postby">
            This media is posted by <label class="label label-info">@<?php echo $postdata[0]->user_name ?></label> to <span class="bold"><i class="fa fa-<?php echo strtolower($postdata[0]->post_sfor) ?>"><?php echo $postdata[0]->post_sfor ?></i></span>
        </div>
        <div class="col-md-12">
            <div class="col-md-4 pad-0">
                <img class="img-responsive" src="<?php echo SITE_URL.$postdata[0]->post_img ?>">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label class="">Title</label>
                    <input type="text" class="form-control" value="<?php echo @$postdata[0]->post_title ?>" placeholder="Post Title">
                </div>
                <div class="form-group">
                    <label class="">Message</label>
                    <input type="text" class="form-control" value="<?php echo @$postdata[0]->post_msg ?>" placeholder="Post Message">
                </div>
                <div class="form-group">
                    <label class="">Tag</label>
                    <input type="text" class="form-control" value="<?php echo @$postdata[0]->post_hashtag ?>" placeholder="Hashtag">
                </div>
                
                <div class="form-group bnt-cnt">
                    <a href="<?php echo base_url() ?>share/facebook" class="btn btn-social btn-facebook">
                        <i class="fa fa-facebook"></i>
                        Share on Facebook
                    </a>
                    <a class="btn btn-social btn-flickr">
                        <i class="fa fa-flickr"></i>
                        Share on Flickr
                    </a>
                    <a class="btn btn-social btn-twitter">
                        <i class="fa fa-twitter"></i>
                        Share on Twitter
                    </a>
                </div>
            </div>
        </div>
        
    </div>
    <div class="table-responsive">
        
       <?php
       echo '<pre>';
       print_r($postdata);
       echo '</pre>';
       ?>
    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('vwFooter');
?>
