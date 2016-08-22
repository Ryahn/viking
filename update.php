<?php 
if ($_SERVER['HTTP_X_GITHUB_EVENT'] == 'push')
	{
		shell_exec("./pull.sh");
	}
?>