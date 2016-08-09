<?php
include('includes/api.php');
logged_in();
admin();

include('head.php');
include('menu.php');
?>

	<div class='container container-admin'>
		<div class='row'>
			<h3><?php echo $m['documentation']; ?></h3>
		</div>
		
		<div class='row'>
			<?php echo $m['click_documentation']; ?>
		</div>
	</div>

<?php
include('footer.php');
?>