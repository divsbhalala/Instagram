<?php
$this->load->view('vwHeader');
?>
<!--  
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Users </h1>
            <ol class="breadcrumb">
                <li><a href="users"><i class="icon-dashboard"></i> Users</a></li>
                <li class="active"><i class="icon-file-alt"></i> Users</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">UserName </th>
                    <th class="header">First Name </th>
                    <th class="header">Last Name </th>
                    <th class="header">Email </th>
                    <th class="header">Social </th>
                    <th class="header">Social id</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user['user_name'] ?></td>
                        <td><?php echo $user['first_name'] ?></td>
                        <td><?php echo $user['last_name'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['social'] ?></td>
                        <td><?php echo $user['socialid'] ?></td>
                       
                    </tr> 
                    <?php
                }
                ?>


            </tbody>
        </table>
    </div>

    <ul class="pagination pagination-sm hidden">
        <li class="disabled"><a href="#"><<</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">>></a></li>
    </ul>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('vwFooter');
?>