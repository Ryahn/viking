<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');
include('login/includes/pbkdf2.php');


if ( isset($_POST['submit'] ) )
{
	if ( $_POST['password'] == $_POST['confirm_password'] )
	{
$username1 = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$platoon = $_POST['platoon'];
$salt = md5($password);
$saltedpass = pbkdf2($password,$salt);
$activate_code1 = md5(sha1($username1 . mt_rand(100, 1000000)));

$regSql = "INSERT INTO login_users (username, email, password,registered_on, permission, active, activate_code, type, platoon)
VALUES ('$username1','$email', '$saltedpass', UNIX_TIMESTAMP(NOW()), 3,0,'$activate_code1','admin','$platoon')";
$regRes = mysqli_query($con, $regSql);
if(!$regRes and $mysqliDebug) 
{
    echo "<p>There was an error in query:". $regRes."</p>";
    echo $con->error;
}

}
else
{
	?>
	<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
        	<div class="col-lg-12">
                <h1 class="page-header">Unit News</h1>
            </div>
            <!-- /.col-lg-12 -->
             <div class="col-md-4"><span class="alert alert-danger">Passwords did not match<span></div>
         </div>
         </div>
         </div>
             <?php
	die();
}
}
?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
        	<div class="col-lg-12">
                <h1 class="page-header">Unit News</h1>
            </div>
            <!-- /.col-lg-12 -->
             <div class="col-md-4"></div>
            <div class="col-md-4">
        <div class="panel panel-default">
                        <div class="panel-heading">
                            Please fill out completely!
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <label>Teamspeak Name</label>
                                            <div class="input-group">
                                            <input type="text" name="username" class="form-control" required="required" />
                                        </div>
                                        </div>
                                      <div class="form-group">
                                      	<label>Password</label>
                                      	<div class="input-group">
                                            <input type="password" class="form-control" name="password" required="required" />
                                        </div>
                                    </div>
                                     <div class="form-group">
                                      	<label>Confirm Password</label>
                                      	<div class="input-group">
                                            <div class="input-group">
                                            <input type="password" class="form-control" name="confirm_password" required="required" />
                                        </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                      	<label>Email</label>
                                      	<div class="input-group">
                                            <div class="input-group">
                                            <input type="email" class="form-control" name="email" required="required" />
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      	<label>Platoon</label>
                                      	<div class="input-group">
                                            <div class="input-group">
                                            <select required="required" name="platoon" class="form-control">
                                            	<option value="nightmare">Nightmare</option>
                                            	<option value="viking">Viking</option>
                                            	<option value="guardian">Guardian</option>
                                            	<option value="rrd">RRD</option>
                                            	<option value="whiskey">Whiskey</option>
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                        
                                        <input type="submit" name="submit" class="btn btn-default" value="Submit"/>
                                       
                                    </form>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
<?php
include('templates/footer.php');
?>