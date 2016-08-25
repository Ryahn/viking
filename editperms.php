<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');
error_reporting(0);

if ( hasRank('SFC') || hasPermission('can_update') )
{
$id = $_GET['id'];
$sql = "SELECT * FROM user_permissions 
inner join rosters on rosters.ruser_id=user_permissions.user_id
WHERE user_id=$id";
$res = mysqli_query($con, $sql);
$perms = array();
while ( $row = mysqli_fetch_assoc($res) )
{
	$perms[] = $row;
}

?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
        	 <div class="col-lg-12">
        	 	<?php foreach ( $perms as $perm ) {
                echo '<h1 class="page-header">Editing: '. $perm['rname'] . '</h1>'; } ?>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
            	<div class="col-md-2"></div>
            	<div class="col-md-8">
            		<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" value="<?php echo $id; ?>" name="id2" />
            			<div class="dataTable_wrapper" style="background-color:rgba(0, 0, 0, 0.72);border-radius:6px;">
                                <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                                	<thead>
                                		<tr>
                                			<th class="center-right-border">Admin</th>
                                			<th class="center-right-border">Nightmare</th>
                                			<th class="center-right-border">Viking</th>
                                			<th class="center-right-border">Guardian</th>
                                			<th class="center-right-border">RRD</th>
                                			<th class="center-right-border">Whiskey</th>
                                			<th class="center-right-border">PL</th>
                                			<th class="center-right-border">2IC</th>
                                			<th class="center-right-border">3IC</th>
                                			<th class="center-right-border">Update</th>
                                			<th class="center-right-border">Delete</th>
                                			<th class="center-right-border">Post</th>
                                			<th class="center-right-border">Edit Post</th>
                                			<th class="center-right-border">Delete Post</th>
                                			<th class="center-right-border">Manage Blog</th>
                                			<th class="center">View</th>
                                		</tr>
                                	</thead>
                                	<tbody>

                                		<tr>
                                			<?php 
                                            foreach ($perms as $perm )
                                            {
                                            if (!hasPermission('is_admin') ){
                                				echo '<td class="center-right-border"><input class="disabled" type="checkbox" value="1" name="admin" /></td>';
                                			}
                                			else
                                			{
                                				if ( $perm['is_admin'] )
                                				{
                                					echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="admin" checked /></td>';
                                				}
                                				else
                                				{
                                					echo '<td class="center-right-border"><input type="checkbox" value="1" name="admin" /></td>';
                                				}
                                			}
                                            if ( $perm['is_nightmare'] )
                                            {
                                			     echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="nightmare" checked/></td>';
                                            }
                                            else
                                            {
                                                 echo '<td class="center-right-border"><input type="checkbox" value="1" name="nightmare"/></td>';
                                            }
                                            if ( $perm['is_viking'] )
                                            {
                                			     echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="viking" checked/></td>';
                                            }
                                            else
                                            {
                                                 echo '<td class="center-right-border"><input type="checkbox" value="1" name="viking" /></td>';
                                            }
                                            if ( $perm['is_guardian'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="guardian" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="guardian" /></td>';
                                            }
                                            if ( $perm['is_rrd'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="rrd" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="rrd" /></td>';
                                            }
                                            if ( $perm['is_whiskey'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="whiskey" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="whiskey" /></td>';
                                            }
                                             if ( $perm['is_pl'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="pl" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="pl" /></td>';
                                            }
                                             if ( $perm['is_2ic'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="2ic" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="2ic" /></td>';
                                            }
                                             if ( $perm['is_3ic'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="3ic" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="3ic" /></td>';
                                            }
                                             if ( $perm['can_update'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="update" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="update" /></td>';
                                            }
                                             if ( $perm['can_delete'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="delete" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="delete" /></td>';
                                            }
                                             if ( $perm['can_post'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="post" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="post" /></td>';
                                            }
                                             if ( $perm['can_edit_post'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="edit_post" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="edit_post" /></td>';
                                            }
                                             if ( $perm['can_delete_post'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="delete_post" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="delete_post" /></td>';
                                            }
                                             if ( $perm['can_manage_blog'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="manage" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="manage" /></td>';
                                            }
                                             if ( $perm['can_view'] )
                                            {
                                                echo '<td class="center-right-border" style="background-color: rgba(0, 158, 0, 0.7);"><input type="checkbox" value="1" name="view" checked/></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="center-right-border"><input type="checkbox" value="1" name="view" /></td>';
                                            }
                                        }?>
                                		</tr>
                                	</tbody>
                                </table>
                            </div>
                            <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
                        </form>
                        <?php
}

if ( isset($_POST['submit']) )
{
function ifEmpty($item)
{
    if (empty($item))
    {
        return false;
    }
    else
    {
        return true;
    }
}

if ( !isset($_POST['admin']) ) { $admin = 0; } else { $admin = true; };
if ( !isset($_POST['guardian'])) { $guardian = 0; } else { $guardian = true; }
if ( !isset($_POST['nightmare']) ) { $nightmare = 0; } else { $nightmare = true; }
if ( !isset($_POST['viking']) ) { $viking = 0; } else { $viking= true; }
if ( !isset($_POST['whiskey']) ) { $whiskey = 0; } else { $whiskey= true; }
if ( !isset($_POST['rrd']) ) { $rrd = 0; } else { $rrd = true; }
if ( !isset($_POST['pl']) ) { $pl = 0; } else { $pl = true; }
if ( !isset($_POST['2ic']) ) { $twoic = 0; } else { $twoic = true; }
if ( !isset($_POST['3ic']) ) { $threeic = 0; } else { $threeic = true; }
if ( !isset($_POST['update']) ) { $update = 0; } else { $update = ture; }
if ( !isset($_POST['post']) ) { $post = 0; } else { $post = true; }
if ( !isset($_POST['delete']) ) { $delete = 0; } else { $delete = true; }
if ( !isset($_POST['edit_post']) ) { $edit_post = 0; } else { $edit_post = true; }
if ( !isset($_POST['delete_post']) ) { $delete_post = 0; } else { $delete_post = true; } 
if ( !isset($_POST['manage']) ) { $manage = 0; } else { $manage = true; }
if ( !isset($_POST['view']) ) { $view = 0; } else { $view = true; }
$userid = $_POST['id2'];

$sql = "UPDATE user_permissions SET is_admin='$admin', is_guardian='$guardian', is_whiskey='$whiskey', is_viking='$viking', is_nightmare='$nightmare', is_rrd='$rrd', is_pl='$pl', is_2ic='$twoic', is_3ic='$threeic', can_update='$update', can_delete='$delete', can_post='$post', can_edit_post='$edit_post', can_delete_post='$delete_post', can_manage_blog='$manage', can_view='$view' WHERE user_id='$userid'";

// echo $sql;
$results = mysqli_query($con, $sql);
if(!$results and $mysqliDebug) 
{
    echo "<p>There was an error in query:". $results."</p>";
    echo $con->error;
}
echo '<a type="button" style="margin-left: 10px;padding: 25px 95px 25px 95px;margin-top: 25px;font-size: 24px;" class="btn btn-info" href="permissions.php">Back</a>';
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div>





