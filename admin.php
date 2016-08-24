<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');

?>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
        	 <div class="col-lg-12">
                <h1 class="page-header">VAS Management</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
        	<div class="col-md-3"></div>
        	<?php
if ( hasPermission('is_admin') )
{
	?>
        	<div class="col-xs-2" style="margin-right:-110px;">
        		<div class="well admin-well">
        			<a href="/permissions.php" type="button" class="btn btn-outline btn-primary" style="color:white;background-color:rgba(62, 105, 142, 0.6);">Manage</a>
        			User Permissions
        		</div>
        	</div>
        	<!-- /.col-xs-2 -->
        	<div class="col-xs-2" style="margin-right:-110px;">
        		<div class="well admin-well">
        			<button type="button" class="btn btn-outline btn-primary" style="color:white;background-color:rgba(62, 105, 142, 0.6);">Manage</button>
        			Page Maintenance
        		</div>
        	</div>
        	<!-- /.col-xs-2 -->
        	<?php 
        }
        if ( hasRank('SFC') || hasPermission('can_manage_blog') )
        {
        	?>
        	<div class="col-xs-2" style="margin-right:-110px;">
        		<div class="well admin-well" style="padding-bottom: 40px;">
        			<button type="button" class="btn btn-outline btn-primary" style="color:white;background-color:rgba(62, 105, 142, 0.6);">Manage</button>
        			Blog Posts
        		</div>
        	</div>
        	<!-- /.col-xs-2 -->
        	<div class="col-xs-2" style="margin-right:-110px;">
        		<div class="well admin-well" style="padding-bottom: 40px;">
        			<button type="button" class="btn btn-outline btn-primary" style="color:white;background-color:rgba(62, 105, 142, 0.6);">Manage</button>
        			Blog Category
        		</div>
        	</div>
        	<!-- /.col-xs-2 -->
        	<?php 
        }
        else
        {
        	echo '<div class="alert alert-danger">Do not have permission <p>Need to be SFC or have can_manage_blog</p></div>';
        }
        ?>

        </div>
        <!-- /.row -->
        <?php
        if ( hasRank('SFC') || hasPermission('can_update') )
        {
        	?>
         <div class="row">
        	<div class="col-md-3"></div>
        <div class="col-xs-2" style="margin-right:-110px;">
        		<div class="well admin-well" style="padding-bottom: 40px;">
        			<button type="button" class="btn btn-outline btn-primary" style="color:white;background-color:rgba(62, 105, 142, 0.6);">Manage</button>
        			Awards
        		</div>
        	</div>
        	<!-- /.col-xs-2 -->
        	<div class="col-xs-2" style="margin-right:-110px;">
        		<div class="well admin-well">
        			<button type="button" class="btn btn-outline btn-primary" style="color:white;background-color:rgba(62, 105, 142, 0.6);">Manage</button>
        			Attendance Types
        		</div>
        	</div>
        	<!-- /.col-xs-2 -->
        	<div class="col-xs-2" style="margin-right:-110px;">
        		<div class="well admin-well" style="padding-bottom: 40px;">
        			<button type="button" class="btn btn-outline btn-primary" style="color:white;background-color:rgba(62, 105, 142, 0.6);">Manage</button>
        			User LOAs
        		</div>
        	</div>
        	<!-- /.col-xs-2 -->
        	<div class="col-xs-2" style="margin-right:-110px;">
        		<div class="well admin-well" style="padding-bottom: 40px;">
        			<button type="button" class="btn btn-outline btn-primary" style="color:white;background-color:rgba(62, 105, 142, 0.6);">Manage</button>
        			Ranks
        		</div>
        	</div>
        	<!-- /.col-xs-2 -->
        </div>
        <!-- /.row -->
        <?php
    }
    else
        {
        	echo '<div class="alert alert-danger">Do not have permission <p>Need to be SFC or have can_update</p></div>';
        }
    ?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php

include('templates/footer.php');

?>