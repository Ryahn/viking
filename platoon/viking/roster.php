<?php
include('../../config/protection.php');
include('../../templates/head.php');
include('../../templates/nav.php');
include('../../templates/sidebar.php');
date_default_timezone_set("America/Los_Angeles");
$dateFormat = "Y-m-d H:i:s";
$date = new DateTime();
$dateString = $date->format($dateFormat);
$timestamp = strtotime($dateString);

$rsql = "SELECT * FROM rosters";
$results = mysqli_query($con, $bsql);
?>
 <div class="navbar-default sidebar roster-legend-sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    
                        <div class="col-md-12 roster-legend">Legend for Date of Event</div> 
                                                  
                    
                        <div class="col-md-10 roster-legend-element roster-training">Training Day</div><div class="col-xs-1 roster-training">T</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-present">Offical Op</div><div class="col-xs-1 roster-present">P</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-openplay">Open Play</div><div class="col-xs-1 roster-openplay">P</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-rasp">RASP</div><div class="col-xs-1 roster-rasp">P</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-ranger">Ranger School</div><div class="col-xs-1 roster-ranger">P</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-devday">Dev Day/No Event/Holidy</div><div class="col-xs-1 roster-devday">/</div>
                    
                    
                        <div class="col-md-10 roster-legend-element roster-loa">Leave of Absense</div><div class="col-xs-1 roster-loa">-</div>
                    
                    </ul>
                </div>
            </div>
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
                              <div class="col-md-10 roster-spacer-total">Test</div><div class="col-md-2 table-total">Totals</div>
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        
<tr>                                     <th class="center">Rank/Name</th>
                                            <th class="center">Promotion Date</th>
                                            <th class="center">1</th>
           <th class="center">2</th>
           <th class="center">3</th>
           <th class="center">4</th>
           <th class="center">5</th>
           <th class="center">6</th>
           <th class="center">7</th>
           <th class="center">8</th>
           <th class="center">9</th>
           <th class="center">10</th>
           <th class="center">11</th>
           <th class="center">12</th>
           <th class="center">13</th>
           <th class="center">14</th>
           <th class="center">15</th>
           <th class="center">16</th>
           <th class="center">17</th>
           <th class="center">18</th>
           <th class="center">19</th>
           <th class="center">20</th>
           <th class="center">21</th>
           <th class="center">22</th>
           <th class="center">23</th>
           <th class="center">24</th>
           <th class="center">25</th>
           <th class="center">26</th>
           <th class="center">27</th>
           <th class="center">28</th>
           <th class="center">29</th>
           <th class="center">30</th>
           <th class="center">31</th>

           <th class="center">P</th>
           <th class="center">A</th>
           <th class="center">T</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<tr>
<td>SPC R.Carr</td>
<td>7/28/2016</td>
<td class="present">P</td>
<td class="training">T</td>
<td class="devday">/</td>
<td class="loa">-</td>
<td class="absent">A</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>T</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>P</td>
<td>28</td>
<td>1</td>
<td>1</td>

                                    	</tr>
<?php
// if ( mysqli_num_rows($results) > 0 ) 
// {
    
//     while($row = mysqli_fetch_assoc($results))
//     {
//     	$timestamp1 = strtotime($row['created_on']);
// 		$month1 = date('F Y', $timestamp1);
//     	if ( $month1 == $month ) {
//     		echo 'User ID: ' . $row['user_id'] .'<br/>Platoon: '. $row['platoon'] .'<br/>Present: '. checkPresent($row['is_present']) .'<br/>Training: '. checkTtraining($row['is_training']) .'<br/>Approved?: '. $row['is_approved'] .'<br/>Approved by: '. $row['approved_by'] .'<br/>Approved on: '. $row['approved_on'] .'<br/><br/>';
//     	} else {
//     		echo 'False';
//     	}
//     }
// }
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
include('../../templates/footer.php');
?>