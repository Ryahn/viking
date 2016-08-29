<?php
function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }

  function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysqli_real_escape_string($input);
    }
    return $output;
}

function isItEmpty($item)
{
  if (empty($item) || $item < 0)
  {
    return 0;
  }
  else
    return $item;
}

function checkStatus($item) 
{
  if ( $item == 'official' )
  {
    return 6;
  }
  elseif ( $item == 'open')
  {
    return 1;
  }
  elseif ( $item == 'rasp')
  {
    return 7;
  }
  elseif ( $item == 'training')
  {
    return 2;
  }
  elseif ( $item == 'ranger')
  {
    return 8;
  }
  elseif ( $item == 'dev')
  {
    return 4;
  }
}

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

function awardCheck($awardid,$input)
{
	if (in_array($awardid, $input)) 
   {
   echo '<td class="award-td-center"><a href="#" class="award-check"><i class="fa fa-check fa-lg"></i></a></td>';
   }
   else
   {
   	echo '<td class="award-td-center"><a href="#" class="award-times"><i class="fa fa-times fa-lg"></i></a></td>';
   }
}

function percentage($num)
{
	return round($num * 100) .'%';
}