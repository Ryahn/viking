<?php
include('../../config/protection.php');
if ( hasRank('SFC') )
{
  echo 'True';
}
else
{
  echo 'False';
}