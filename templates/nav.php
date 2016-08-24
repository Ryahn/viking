<?php 
$auid = userValue(null, "id"); 
$platoon = userValue(null, "platoon");
$navsql = "SELECT * FROM attendances WHERE user_id=$auid ORDER BY id DESC LIMIT 1 ";
$results = mysqli_query($con, $navsql);

?>
<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">VAS</a><br />
                <h5><small id="brand-small">Virtual Attendence System</small>
                </h5>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <?php
                    if ( hasRank('SFC') || hasPermission('can_update') )
                    {
                        ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-messages">
                        <?php if (hasPermission('is_admin') )
                        {
                            ?>
                        <li>
                            <a href="/login/controlpanel.php">
                                <div>
                                    <strong>Admin Panel</strong>
                                    <span class="pull-right text-muted">
                                        <em>Manage Users, etc</em>
                                    </span>
                                </div>

                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php }
                        ?>
                        <li>
                            <a href="/admin.php">
                                <div>
                                    <strong>VAS Manager</strong>
                                    <span class="pull-right text-muted">
                                        <em>Manage VAS</em>
                                    </span>
                                </div>
                            </a>
                        </li>
                        
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <?php } ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ urlFor('user.profile', {username: auth.username}) }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="{{ urlFor('account.profile') }}"><i class="fa fa-gear fa-fw"></i> Update Profile</a>
                        </li>
                        <li><a href="{{ urlFor('password.change') }}"><i class="fa fa-key fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ urlFor('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
<?php
if ( mysqli_num_rows($results) > 0 ) 
{
    $dateFormat = "Y-m-d H:i:s";
    $date = new DateTime();

        while($row = mysqli_fetch_assoc($results))
        {
            $createdString = $row['created_on'];
            $createdDate   = new DateTime($createdString);
            $laterDate     = clone $createdDate;
            $laterInterval = new DateInterval('PT4H');
            $dateString = $date->format($dateFormat);
            $laterDate->add($laterInterval);

                
                if ( $row['is_approved'] == 1 )
                    {
                    ?>
                    <form action='attended.php' method='post' role='form'>
                        <div class='attend-form form-group'>
                            <div class='attend-form col-xs-1'>
                                <select class='form-control attend-select' name='type'>
                                    <option value="official">Official OP</option>
                                    <option value="open">Open Play</option>
                                    <option value="rasp">RASP</option>
                                    <option value="training">Training</option>
                                    <option value="ranger">Ranger School</option>
                                    <option value="dev">Dev/No Event</option>
                                </select>

                            </div>
                                <input type="hidden" value="<?php echo $auid; ?>" name="id1"/>
                                <input type="hidden" value="<?php echo $platoon; ?>" name="platoon1"/>
                                <input type='submit' value='Submit' name='submit' class='btn btn-primary attend-submit'/>
                         </div>
                          </form>
                          <?php
                } elseif ( $date > $laterDate )
                {
                    ?>
                    <form action='attended.php' method='post' role='form'>
                        <div class='attend-form form-group'>
                            <div class='attend-form col-xs-1'>
                                <select class='form-control attend-select' name='type'>
                                    <option value="official">Official OP</option>
                                    <option value="open">Open Play</option>
                                    <option value="rasp">RASP</option>
                                    <option value="training">Training</option>
                                    <option value="ranger">Ranger School</option>
                                    <option value="dev">Dev/No Event</option>
                                </select>

                            </div>
                                <input type="hidden" value="<?php echo $auid; ?>" name="id1"/>
                                <input type="hidden" value="<?php echo $platoon; ?>" name="platoon1"/>
                                <input type='submit' value='Submit' name='submit' class='btn btn-primary attend-submit'/>
                         </div>
                          </form>
                          <?php
                } else
                {
                    echo "<div class='attend-no'><a type='button' class='btn btn-primary btn-lg disabled attend-no-button'>" . $createdDate->diff($date)->format('%hH %iM') . "</a></div>";
                }
        }
}
else
{
    ?>
   <form action='attended.php' method='post' role='form'>
                        <div class='attend-form form-group'>
                            <div class='attend-form col-xs-1'>
                                <select class='form-control attend-select' name='type'>
                                    <option value="official">Official OP</option>
                                    <option value="open">Open Play</option>
                                    <option value="rasp">RASP</option>
                                    <option value="training">Training</option>
                                    <option value="ranger">Ranger School</option>
                                    <option value="dev">Dev/No Event</option>
                                </select>

                            </div>
                                <input type="hidden" value="<?php echo $auid; ?>" name="id1"/>
                                <input type="hidden" value="<?php echo $platoon; ?>" name="platoon1"/>
                                <input type='submit' value='Submit' name='submit' class='btn btn-primary attend-submit'/>
                         </div>
                          </form>
                          <?php
}
?>