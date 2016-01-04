<?php
$this->load->view('vwHeader');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css">
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $ptitile; ?> Post </h1>
        </div>
    </div><!-- /.row -->
    <div class="table-responsive">
        <table class="table table-hover tablesorter" id="userpost-table">
            <thead>
                <tr>
                    <th class="header">UserName </th>
                    <th class="header">Image </th>
                    <th class="header">Post To </th>
                    <th class="header">Title</th>
                    <th class="header">Message </th>
                    <th class="header">Tags </th>
                    <th class="header">Post at</th>
                    <th class="header">Share</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users1=array();
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user->user_name ?></td>
                        <td>
                            <a class="fancybox" href="http://sociallabels.imnwebhosting.com/photos/<?php echo  str_replace('photos/', '', $user->post_img);?>">
                                <img width="100px" src="<?php echo IMAGES_PATH; ?>thumb/<?php echo  str_replace('photos/', '', $user->post_img); ?>">
                            </a>
                        </td>
                        <td><?php echo $user->post_sfor ?></td>
                        <td><?php echo $user->post_title ?></td>
                        <td><?php echo $user->post_msg ?></td>
                        <td><?php echo $user->post_hashtag ?></td>
                        <td><?php
                        $date=date_create($user->created_at);
                        echo date_format($date,"d - M- Y"); ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>socialpost/share/<?php echo base64_encode($user->post_id); ?>" class="btn btn-info">
                                <i class="fa fa-share-alt"></i>
                                Share
                            </a>
                        </td>
                       
                    </tr> 
                    <?php
                }
                ?>


            </tbody>
        </table>
    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('vwFooter');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>vendor/jquery.sortelements.js" type="text/javascript"></script>
<script src="<?php echo HTTP_JS_PATH; ?>jquery.bdt.js" type="text/javascript"></script>
<script>
    $(document).ready( function () {
        $('#userpost-table').bdt();
        jQuery(function() {
  $("a.fancybox").fancybox();
});
    });
</script>