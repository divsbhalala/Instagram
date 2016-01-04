<?php
$this->load->view('vwHeader');
?>

<!-- Page Specific Plugins -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- Page Specific CSS -->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Dashboard <small>Statistics Overview</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo @$total_usr; ?></p>
                            <p class="announcement-text"></p>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer announcement-bottom">
                        <div class="row redirectusers">
                            <div class="col-xs-6">
                                Total Users
                            </div>
                            <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-facebook fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo @$total_fb; ?></p>
                            <p class="announcement-text"></p>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Facebook Post
                            </div>
                            <div class="col-xs-4 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-twitter fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo @$total_twitter; ?></p>
                            <p class="announcement-text"></p>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Twitter Post
                            </div>
                            <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-flickr fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"><?php echo @$total_flicker; ?></p>
                            <p class="announcement-text"></p>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Flickr Post
                            </div>
                            <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div><!-- /.row -->


    <div class="row">

        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Post via User</h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php
                        if (isset($ppost) && count($ppost) > 0) {
                            foreach ($ppost as $p) {
                                ?>

                               <a href="#" class="list-group-item">
                                    <span class="badge"><?php echo $p->created_at; ?></span>
                                    <i class="fa fa-<?php echo strtolower($p->post_sfor); ?>"></i> 
                                    <?php echo $p->user_name ?> share @<?php echo $p->post_sfor; ?>
                                </a>
                                <?php
                            }
                        }
                        else{
                            ?>
                         <a href="#" class="list-group-item">
                                    No Data Available
                                </a>
                                <?php
                        }
                        ?>
                    </div>
                    <div class="text-right">
                        <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Post via wall</h3>
                </div>
                <div class="panel-body">
                   <div class="list-group">
                        <?php
                        if (isset($wpost) && count($wpost) > 0) {
                            foreach ($wpost as $p) {
                                ?>

                                <a href="#" class="list-group-item">
                                    <span class="badge"><?php echo $p->created_at; ?></span>
                                    <i class="fa fa-<?php echo strtolower($p->post_sfor); ?>"></i> 
                                    <?php echo $p->user_name ?> share @<?php echo $p->post_sfor; ?>
                                </a>
                                <?php
                            }
                        }else{
                            ?>
                         <a href="#" class="list-group-item">
                                    No Data Available
                                </a>
                                <?php
                        }
                        ?>
                    </div>
                    <div class="text-right">
                        <a href="socialpost">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.row -->

</div><!-- /#page-wrapper -->


<!--  PAge Code Ends here -->
<?php
$this->load->view('vwFooter');
?>
<script>
    $(document).on('click', '.redirectusers', function () {
        window.location.replace('users')
    })
</script>