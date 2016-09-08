<?php
include('config/protection.php');
$uid = $_GET['uid'];
$enjinrank = $_GET['rank'];
$enjinname = $_GET['username'];


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
    #topmenu {
    	height: 60px;
    	width: 100px;
    }
    #profile-tab {
    	height: 100px;
    	width: 185px;
    }
    #profile {
    	height: 165px;
    	width: 325px;
    }
    #unit {
    	height: 160px;
    	width: 386px;
    }
    </style>
</head>

<body>
	<div id="page-wrapper">
    	<div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Player ID For Squad XML</h1>
	        </div>
	        <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
  		<div class="col-md-8">
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
                                	
                                	<input style="width:200px" type="text" class="form-control" name="playerid1" maxlength="17" required />
                               
                                	<input type="hidden" name="enjinid" value="<?php echo $uid; ?>" />
                                </div>

                                <input type="submit" name="submit" class="btn btn-default" value="Submit"/>
                                <button type="reset" class="btn btn-default">Reset Button</button>
                            </form>
                        </div>
                       
                    </div>
                     <?php
if (isset($_POST['submit']))
{
	if (strlen($_POST['playerid1']) >= 17 && is_numeric($_POST['playerid1']))
	{
	$sql = "INSERT INTO player_id (id, playerID)
	VALUES ( '". $_POST['enjinid'] ."', '". $_POST['playerid1'] ."' )";
	$results = mysqli_query($con, $sql);
		if(!$results and $mysqliDebug) {
		   echo "<p>There was an error in query:". $results."</p>";
		   echo $con->error;
		}
	}
	elseif (!is_numeric($_POST['playerid1']))
	{
		echo '<div style="margin-top:10px" class="alert alert-danger">Player ID is not corrent. Must be numeric. Your Player ID is: '. $_POST['playerid1'] . '</div>';
	}
	else
	{
		echo '<div style="margin-top:10px" class="alert alert-danger">Player ID is not corrent. Must be 17 characters long. Your Player ID is: '. strlen($_POST['playerid1']) . '</div>';
	}
}
?>
                </div>
            </div>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">How To Get Player ID (Arma 3: APEX)</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                        	Viking has a Squad XML which allows all Viking members to display the Viking patch on their right shoulder. In order to obtain the patch, you must follow these steps:
							<p><strong>Step 1:</strong> Open Arma 3, place your mouse pointer on icon in the top right of the main menu (left of the exit button)<br />
								<img id="topmenu" src="http://i.imgur.com/LZomPqN.png" /></p>

							<p><strong>Step 2:</strong> Click on your profile name to get to the profile editor.<br />
								<img id="profile-tab" src="http://i.imgur.com/8Uvh0mT.png" />

							<p><strong>Step 3:</strong> Click on the UNIT tab in the profile editor<br />
								<img id="profile" src="http://i.imgur.com/K1cKAPw.png" />

							<p><strong>Step 4:</strong> Click EDIT, then highlight the Player ID, copy and
							paste (using CTRL+C and CTRL+V) it and send it to a SNCO. 
							<br />Then, copy and paste the 
							Squad’s URL that the SNCO gives you into the Squad XML section.<br />
								<img id="unit" src="http://i.imgur.com/yhT4LHY.png" /></p>

							<p><strong>Step 5:</strong> Hit Apply. Congratulations! You are now representing 2nd platoon!</p>

							<div class="alert alert-info">*NOTE: You will know that the XML is working when you log into the server and your name 
automatically changes to have a [2nd] tag after it. Or just log into the server and see if you 
have our patch on your right shoulder.</div>


                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</body>
</html>