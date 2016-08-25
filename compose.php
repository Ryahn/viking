<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');
$userid = userValue(null, "id");
?>
<div id="wrapper">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
                <h1 class="page-header">Composing Message</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
        	<div class="col-md-8">
		<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div class="form-group">
                <label>Title</label>
                <div class="input-group">
                	<input type="text" name="title" class="form-control" required="required" size="30" />
                	<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
            	</div>
            </div>
            <div class="form-group">
                <label>Category</label>
                <div class="input-group">
                	<select name="category" class="form-control" required="required">
                		<option value="1">Global</option>
                		<option value="2">Nightmare</option>
                		<option value="3">Viking</option>
                		<option value="4">Guardian</option>
                		<option value="5">RRD</option>
                		<option value="6">Whiskey</option>
                	</select>
            	</div>
            </div>
            <div class="form-group">
                <label>Content</label> <span style="padding:4px;" class="alert alert-danger"><b><u>NOTE</u>:</b> Do not use images over 600px x 600px</span>
                <div class="input-group">
            		<textarea name="editor1" id="editor1" rows="10" cols="80">
            		</textarea>
            		<script>
                	// Replace the <textarea id="editor1"> with a CKEditor
                	// instance, using default configuration.
                	CKEDITOR.replace( 'editor1' );
            		</script>
            	</div>
            </div>
            <div class="form-group">
            	<div class="input-group">
            		<input type="submit" value="Submit" name="submit" class="btn btn-primary" />
            	</div>

            </div>
        </form>
        <?php
            	if( isset($_POST['submit']) )
{
	$dateFormat = "Y-m-d H:i:s";
	$date = new DateTime();
	$dateString = $date->format($dateFormat);
	$userid2 = $_POST['userid'];
	$title = $_POST['title'];
	$category = $_POST['category'];
	$body = mysqli_real_escape_string($con,$_POST['editor1']);

	$sql = "INSERT INTO blog_posts (authorID,title,catID,body,published,publish_date)
	VALUES ('$userid2','$title','$category','$body',1,'$dateString')";
	$results = mysqli_query($con, $sql);
	if(!$results and $mysqliDebug) 
	{
    	echo "<p>There was an error in query:". $results."</p>";
    	echo $con->error;
	}
	if ($results)
	{
	echo '<span class="alert alert-success">Post submitted!</span>';
}
}
?>
    </div>
    </div>

</div>
</div>
<?php
include('templates/footer.php');






?>