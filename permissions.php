<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');
$grabUsers = "SELECT * FROM rosters,ranks
INNER JOIN user_ranks on user_ranks.rank_id=ranks.id
WHERE rankid <=24 AND rosters.ruser_id=user_ranks.user_id
GROUP BY rosters.rname 
ORDER BY ranks.id,rosters.rname";
$grabResults = mysqli_query($con, $grabUsers);

?>


        

           

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="center">Username</th>
                                            <th class="center">Admin</th>
                                            <th class="center">Guardian</th>
                                            <th class="center">Nightmare</th>
                                            <th class="center">Viking</th>
                                            <th class="center">Whiskey</th>
                                            <th class="center">RRD</th>
                                            <th class="center">Platoon Lead</th>
                                            <th class="center">Platoon 2IC</th>
                                            <th class="center">Platoon 3IC</th>
                                            <th class="center">Update</th>
                                            <th class="center">Delete</th>
                                            <th class="center">Can Post</th>
                                            <th class="center">Edit Post</th>
                                            <th class="center">Manage Blog</th>
                                            <th class="center">View System</th>
                                            <th class="center"></th>
                                            <th class="center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        function vasPermCheck($permID) {
                                            if ($permID == 1) {
                                                echo "<span style=\"color:lime;\">YES</span>";
                                            } else {
                                                echo "<span style=\"color:red;\">NO</span>";
                                        }
                                        }
                                        if(!$grabResults and $mysqliDebug) {
    echo "<p>There was an error in query: $grabUsers</p>";
    echo $con->error;
}
if($grabResults) {
    while($row = mysqli_fetch_assoc($grabResults)) {
        $id = $row['ruser_id'];
        $grabPerms = "SELECT * FROM user_permissions WHERE user_id=$id";
        $grabPresults = mysqli_query($con, $grabPerms);
        if(!$grabPresults and $mysqliDebug) {
            echo "<p>There was an error in query: $grabUsers</p>";
            echo $con->error;
        }
        while($prow = mysqli_fetch_assoc($grabPresults)) {
            ?>
        
                                        
                                        <tr>
                                            <td><?php echo '<img style="vertical-align:text-bottom;" height="20px" src="' . $row['base64'] . '"/> '. $row['rname']; ?></td>
                                             <td class="center"><?php vasPermCheck($prow['is_admin']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['is_guardian']);?></td>
                                            <td class="center"><?php vasPermCheck($prow['is_nightmare']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['is_viking']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['is_whiskey']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['is_rrd']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['is_pl']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['is_2ic']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['is_3ic']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['can_update']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['can_delete']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['can_post']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['can_edit_post']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['can_manage_blog']);?></td>
                                             <td class="center"><?php vasPermCheck($prow['can_view']);?></td>
                                            <td><?php echo "<a class='btn btn-success btn-xs center' href='editperms.php?id=" . $prow['user_id'] . "'>EDIT</a>";?></td>
                                            <td><?php if ( hasPermission('can_delete') ) { echo "<a class='btn btn-danger btn-xs center' href='delperms.php?id=" . $prow['user_id'] . "'>DELETE</a>"; } else { echo "<a class='btn btn-danger btn-xs disabled center' href='#'>DELETE</a>"; }?></td>
                                        </tr>
                                        <?php
                                        }
    }
}
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            
            
        </div>
        <!-- /#page-wrapper -->

    <?php
include('templates/footer.php');
?>