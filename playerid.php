<?php
include('config/protection.php');
$uid = $_GET['uid'];
$enjinrank = $_GET['rank'];
$enjinname = $_GET['username'];

if (isset($_POST['submit']))
{
	$sql = "INSERT INTO player_id (id, playerID)
	VALUES ( '". $_POST['enjinid'] ."', '". $_POST['playerid'] ."' )";
	$results = mysqli_query($con, $sql);
		if(!$results and $mysqliDebug) {
		   echo "<p>There was an error in query:". $results."</p>";
		   echo $con->error;
		}
}
?>
<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- Bootstrap Core CSS -->
    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/assets/dist/js/sb-admin-2.js"></script>
    <style type="text/css">
    body {
    	background-color:transparent;
    	background-image:none;
    }
    #page-wrapper {
    	margin: 0 0 0 0;
    }
    </style>
</head>

<body>
	<div id="page-wrapper">
    	<div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Leave of Absence</h1>
	        </div>
	        <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
  		<div class="col-md-6">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Please fill out completely!
                </div>
                <div class="panel-body">
                	<div class="row">
                        <div class="col-md-10">
                            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="form-group">
                                	<p class="form-control-static"><?php echo $enjinrank . " " . $enjinname; ?></p>
                                </div>
                                <div class="form-group">
                                	<label>Arma Player ID</label>
                                	<input type="text" class="form-control" name="playerid" />
                                	<input type="hidden" value="<?php echo $uid; ?>" />
                                </div>

                                <input type="submit" name="submit" class="btn btn-default" value="Submit"/>
                                <button type="reset" class="btn btn-default">Reset Button</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>