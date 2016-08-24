<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');

$postid = $_GET['id'];
$postSQL = "SELECT * FROM blog_posts
inner join blog_cat on blog_cat.id=blog_posts.catID
inner join rosters on rosters.ruser_id=blog_posts.authorID
WHERE postID=$postid AND published=1";
$postres = mysqli_query($con, $postSQL);


?>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
        	<?php while ( $row = mysqli_fetch_assoc($postres) )
        	{
        		$postDate = date('m/d/y H:i:s',strtotime($row['publish_date']));
        		if ( !empty($row['modified_date']) )
        		{
        			$modDate = date('m/d/y H:i:s',strtotime($row['modified_date']));
        		}
        		else
        		{
        			$modDate = FALSE;
        		}
        		$userid = $row['authorID'];
        		$ranksql = "SELECT * FROM user_ranks
        		inner join ranks on ranks.id=user_ranks.rank_id
        		WHERE user_id=$userid
        		GROUP BY user_id";
        		$rankres = mysqli_query($con, $ranksql);
        		while ( $row2 = mysqli_fetch_assoc($rankres) )
        		{
        		?>
			<div class="col-lg-12">
                <h1 class="page-header"><?php echo $row['title']; ?></h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
            	<div class="col-md-2"></div>
            	<div class="col-md-6" style="margin-left:16px;">
            		<div class="panel panel-default">
            			<div class="panel-heading">
            				<h4>Posted by: <?php echo '<img style="vertical-align: text-bottom;" height="25px" src="' . $row2['base64'] . '"/> ' . $row['rname']; ?></h4>
            			</div>
       					<div class="panel-body">
            	<div class="well post-well">
            		<?php echo $row['body']; ?>
            	</div>
            	<div class="panel-footer post-footer">
            		<span class="label label-info">Posted:</span> <?php echo $postDate; if ( $modDate ) { echo ' <span class="label label-default">Modified:</span> ' . $modDate; } ?>
            	</div>
            </div>
        </div>
            </div>
        </div>
            <?php
        }
    }
        ?>


</div>
</div>
</div>

<?php
include('templates/footer.php');
?>