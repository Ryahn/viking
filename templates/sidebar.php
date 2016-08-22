<?php

$mysqliDebug = 1;
$uplatoon1 = userValue(null, "platoon");
$nsql = "SELECT * FROM attendances WHERE platoons='viking' AND is_approved=0";
$results = mysqli_query($con, $nsql);
if(!$results and $mysqliDebug) {
    echo "<p>There was an error in query: $results</p>";
    echo $con->error;
}
$needApproval = mysqli_num_rows($results);
?>
 <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">

                            <!-- <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div> -->
                            <!-- /input-group -->
                        </li>
                        <?php if ( hasPermission('is_admin') )
                        {?>
                        <li>
                            <a href="/login/controlpanel.php"><i class="fa fa-bar-chart-o fa-fw"></i> Admin</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="/"><i class="fa fa-dashboard fa-fw"></i>
                            <?php 
                            if ( $uplatoon1 == 'viking' )
                            {
                                echo 'VDashboard';
                            }
                            elseif ( $uplatoon1 == 'guardian' )
                            {
                                echo 'GDashboard';
                            }
                            elseif ( $uplatoon1 == 'nightmare' )
                            {
                                echo 'NDashboard';
                            }
                            elseif ( $uplatoon1 == 'rrd' )
                            {
                                echo 'RDashboard';
                            }
                            elseif ( $uplatoon1 == 'whiskey' )
                            {
                                echo 'WDashboard';
                            }
                            else
                            {
                                echo 'Dashboard';
                            }

                            
                            ?>
                        </a>
                        </li>
                        <li>
                            <a href="<?php echo '/platoon/' . $uplatoon1 .'/roster.php'; ?> "><i class="fa fa-list-alt fa-fw"></i> Roster</a>
                            
                        </li>
                        <li>
                            <a href="<?php echo '/platoon/' . $uplatoon1 .'/attendance.php'; ?> "><i class="fa fa-table fa-fw"></i> Attendance
                                <?php
                                if (hasPermission('can_update') && $needApproval > 0 )
                            {
                                echo '<span class="badge" style="background-color:rgb(214, 0, 0);"> '.$needApproval .'</span> <small style="font-size:75%;color:white;">Need Approved</small></a>';
                            }
                            else
                            {
                                echo '</a>';
                            }
                            ?>
                        </li>
                        <li>
                            <a href="<?php echo '/platoon/' . $uplatoon1 .'/submit-loa.php'; ?>"><i class="fa fa-edit fa-fw"></i> Submit Leave of Absense</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-trophy fa-fw"></i> Awards</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo '/platoon/' . $uplatoon1 .'/awards.php'; ?>"> View</a>
                                </li>
                                <?php if ( hasPermission('can_update') || hasPermission('is_pl') || hasPermission('is_2ic') )
                                { ?>
                                <li>
                                    <a href="<?php echo '/platoon/' . $uplatoon1 .'/manage-awards.php'; ?>"> Manage</a>
                                </li>
                                <?php } ?>
                        </li>
                       
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
               
            </div>
            <!-- /.navbar-static-side -->


        </nav>
