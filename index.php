<?php
include('config/protection.php');
include('templates/head.php');
include('templates/nav.php');
include('templates/sidebar.php');

function postsLength($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}


$blogsql = "SELECT * FROM blog_posts
inner join blog_cat on blog_cat.id=blog_posts.catID
inner join rosters on rosters.ruser_id=blog_posts.authorID
WHERE catID=1 AND published=1
ORDER BY publish_date ASC
LIMIT 3";
$blogresults = mysqli_query($con, $blogsql);

$recentPromoSql = "SELECT * from rosters,ranks
inner join user_ranks on user_ranks.rank_id=ranks.id
where rosters.ruser_id = user_ranks.user_id
ORDER BY rpromoted_on DESC
LIMIT 3";
$recentResults = mysqli_query($con, $recentPromoSql);

$recentAwardSql = "SELECT * FROM user_awards
inner join awards on awards.id=user_awards.award_id
inner join rosters on rosters.ruser_id=user_awards.user_id
ORDER BY award_date DESC
LIMIT 3";
$awardres = mysqli_query($con, $recentAwardSql);



 

?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
        <?php
        if ( hasPermission('can_view') )
        {
      
            if(!$blogresults and $mysqliDebug) 
                {
                    echo "<p>There was an error in query:". $blogresults."</p>";
                    echo $con->error;
                }
                if(!$recentResults and $mysqliDebug) 
                {
                    echo "<p>There was an error in query:". $recentResults."</p>";
                    echo $con->error;
                }
                if(!$awardres and $mysqliDebug) 
                {
                    echo "<p>There was an error in query:". $awardres."</p>";
                    echo $con->error;
                }
            
            $bposts = array();
            while ( $row = mysqli_fetch_assoc($blogresults) )
                {
                    $bposts[] = $row;
                }
            $recentRanks = array();
            while ( $row2 = mysqli_fetch_assoc($recentResults) )
                {
                    $recentRanks[] = $row2;
                }
            $recentAwards = array();
            while ( $row3 = mysqli_fetch_assoc($awardres) )
                {
                    $recentAwards[] = $row3;

                }
        ?>
            <div class="col-lg-12">
                <h1 class="page-header">Unit News</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-md-6"><h2>Accouncements</h2></div>
            <div class="col-md-3"><h2>Recent Promotions</h2></div>
            <div class="col-md-3"><h2>Recent Awards</h2></div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
        <?php foreach ( $bposts as $posts )
        {
            $postDate = date('m/d/y H:i:s',strtotime($posts['publish_date']));
            if ( !empty($posts['modified_date']) )
                {
                    $modDate = date('m/d/y H:i:s',strtotime($posts['modified_date']));
                }
                else
                {
                    $modDate = FALSE;
                }
            $rank_user = $posts['ruser_id'];
            $ranksql = "SELECT * FROM user_ranks 
            inner join ranks on ranks.id=user_ranks.rank_id
            WHERE user_id=$rank_user";
            $rankresults = mysqli_query($con, $ranksql);
             if(!$rankresults and $mysqliDebug) 
                {
                    echo "<p>There was an error in query:". $rankresults."</p>";
                    echo $con->error;
                }
                $branks = array();
            while ( $row1 = mysqli_fetch_assoc($rankresults) )
                {
                    $branks[] = $row1;
                }
                foreach ( $branks as $ranks )
                {
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $posts['title']; ?></h3>
                </div>
                <div class="panel-body">
                    <?php echo postsLength($posts['body'],100); ?>
                </div>
                <div class="panel-footer panel-footer-post">
                   <?php echo '<span class="label label-info">By:</span> <img height="18px" style="vertical-align:top;" src="' . $ranks['base64'] .'"/> ' . $posts['rname']; echo ' <span class="label label-warning">Posted:</span> ' . $postDate; if ( $modDate ) { echo ' <span class="label label-default">Modified:</span> ' . $modDate; }  echo ' <span class="label label-primary">Tags:</span> ' . $posts['cat_name']; ?>
                   <?php echo '<span style="float:right;"><a class="btn btn-danger btn-xs" href="viewpost.php?id='. $posts['postID'] .'">Read</a></span>'; ?>
                </div>
            </div>
        
        
        
        <?php
    }
}
    ?>
    </div>

    <div class="col-md-3">
        <?php
        foreach ( $recentRanks as $rRanks )
        {
            $promotionDate = date('m/d/y',strtotime($rRanks['rpromoted_on']));
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php 
                    if ($rRanks['rplatoon'] == 'viking') 
                    { 
                        echo 'Name: '. $rRanks['rname'] . ' <span class="label label-viking">2<sup>nd</sup></span>';
                    }
                    elseif ($rRanks['rplatoon'] == 'guardian') 
                    { 
                        echo 'Name: '. $rRanks['rname'] . ' <span class="label label-guardian">3<sup>rd</sup></span>';
                    } 
                    elseif ($rRanks['rplatoon'] == 'nightmare') 
                    { 
                        echo 'Name: '. $rRanks['rname'] . ' <span class="label label-nightmare">1<sup>st</sup></span>';
                    } 
                    elseif ($rRanks['rplatoon'] == 'rrd') 
                    { 
                        echo 'Name: '. $rRanks['rname'] . ' <span class="label label-rrd">RRD</span>';
                    }
                    elseif ($rRanks['rplatoon'] == 'whiskey') 
                    { 
                        echo 'Name: '. $rRanks['rname'] . ' <span class="label label-whiskey">AIR</span>';
                    }
                    ?></h3>
                </div>
                <div class="panel-body">
                    Promoted to: <?php echo $rRanks['name_desc'] . ' <img height="20px" src="' . $rRanks['base64'] . '"/>';?>
                </div>
                <div class="panel-footer panel-footer-post">
                   Promoted on: <?php echo $promotionDate; ?>
                </div>
            </div>
            <?php
        }
        ?>
        </div>

        <div class="col-md-3"><?php
            foreach ( $recentAwards as $awards )
            {
                $awardDate = date('m/d/y',strtotime($awards['award_date']));
            ?>
            <div class="panel panel-default">
                <div class="panel-heading" id="<?php echo $awards['image_name']; ?>2">
                    <h3 class="panel-title"><?php 
                    if ($awards['rplatoon'] == 'viking') 
                    { 
                        echo 'Name: '. $awards['rname'] . ' <span class="label label-viking">2<sup>nd</sup></span>';
                    }
                    elseif ($awards['rplatoon'] == 'guardian') 
                    { 
                        echo 'Name: '. $awards['rname'] . ' <span class="label label-guardian">3<sup>rd</sup></span>';
                    } 
                    elseif ($awards['rplatoon'] == 'nightmare') 
                    { 
                        echo 'Name: '. $awards['rname'] . ' <span class="label label-nightmare">1<sup>st</sup></span>';
                    } 
                    elseif ($awards['rplatoon'] == 'rrd') 
                    { 
                        echo 'Name: '. $awards['rname'] . ' <span class="label label-rrd">RRD</span>';
                    }
                    elseif ($awards['rplatoon'] == 'whiskey') 
                    { 
                        echo 'Name: '. $awards['rname'] . ' <span class="label label-whiskey">AIR</span>';
                    }
                    ?></h3>
                </div>
                <div class="panel-body">
                    Award Given: <?php echo $awards['award_name']; ?>
                </div>
                <div class="panel-footer panel-footer-post">
                   Awarded on: <?php echo $awardDate; ?>
                </div>
            </div>
            <?php
        }
    }
    else
    {
        echo '<div class="alert alert-danger">Cannot view this</div>';
    }
        ?>
        </div>
            
            </div>
        
        </div>
        </div>
        <!-- /#page-wrapper -->
</div>





<?php
include('templates/footer.php');
?>