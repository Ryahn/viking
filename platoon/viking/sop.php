<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
?>

<div id="wrapper">
	<div id="page-wrapper" style="padding-top:30px;">
	 	<div class="row">
		 	<div class="panel panel-default">
		 		<div class="panel-heading">
		 			Standard Operating Procedure
		 		</div>
		 		<!-- /.panel-heading -->
		 		<div class="panel-body">
		 			<!-- Nav Tabs -->
		 			<ul class="nav nav-tabs">
		 				<li class="active">
		 					<a href="#home" data-toggle="tab">
		 						Home
		 					</a>
		 				</li>
		 				<li>
		 					<a href="#loudouts" data-toggle="tab">
		 						Loadouts
		 					</a>
		 				</li>
		 				<li>
		 					<a href="#promotions" data-toggle="tab">
		 						Promotions
		 					</a>
		 				</li>
		 			</ul>
		 			<!-- /Nav Tabs -->
		 			<!-- Tab panes -->
		 			<div class="tab-content">
		 				<div class="tab-pane fade in active" id="home">
		 					Content for home
		 				</div>
		 				<div class="tab-pane fade" id="loudouts">
		 					Content for loadouts
		 				</div>
		 				<div class="tab-pane fade" id="promotions">
		 					Content for promotions
		 				</div>
		 			</div>
		 			<!-- /Tab panes -->
		 		</div>
		 		<!-- /.panel-body -->
		 	</div>
		 	<!-- /.panel -->
	 	</div>
	 	<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php
include('../../templates/footer.php');
?>