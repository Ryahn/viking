<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');
$uid = userValue(null, "id");

?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Viking News</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
     <span style="color:white;">
     <?php echo userValue(null, "platoon"); ?></span>
            
            
            
        </div>
        <!-- /#page-wrapper -->






<?php
include('templates/footer.php');
?>