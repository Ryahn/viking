<?php

function GetPlayerID($id)
{
	include('../../config/db.php');
	$mysqliDebug = 1;
	$sql = "SELECT * FROM player_id WHERE id=$id";
	$results = mysqli_query($con, $sql);
		if(!$results and $mysqliDebug) {
		   echo '<div style="margin-top:10px" class="alert alert-danger">There was an error in query:'. $results.'</div>';
		   echo $con->error;
		}
	while($row = mysqli_fetch_assoc($results))
	{
		return $row['playerID'];
	}
}


$result = file_get_contents('../21st.json');
$json = json_decode($result,true);


$tags = $json['tags'];
$TOC = $json['tags']['1092531']['users'];
$RRDLead = $json['tags']['1656129']['users'];
$RRD = $json['tags']['1518730']['users'];
$GLead = $json['tags']['1217502']['users'];
$Guardian = $json['tags']['1217510']['users'];
$NLead = $json['tags']['1167334']['users'];
$Nightmare = $json['tags']['1065783']['users'];
$VLead = $json['tags']['1167327']['users'];
$Viking = $json['tags']['1065785']['users'];
$WLead = $json['tags']['1167327']['users'];
$Whiskey = $json['tags']['1065786']['users'];



$xml = new SimpleXMLElement('<xml/>');
$squad = $xml->addChild('squad');
$squad->addAttribute('nick', 'Whiskey');
$squad->addChild('name', 'Air Team "Whiskey"');
$squad->addChild('email','21stusarmyrangers@gmail.com');
$squad->addChild('web','http://21starmyrangers.enjin.com/whiskey');
$squad->addChild('picture','624141a59e2fa0dfe0225e4a9531cc31.paa');
$squad->addChild('title','Air Team "Whiskey" / 21st Ranger Regiment');
$first = true;
foreach ( $Whiskey as $userId )
{
	
		foreach ( $WLead as $userId1 )
		{
			if ( $first ) 
	{

			$user = isset($json['users'][$userId1]) ? $json['users'][$userId1] : null;

			$tags = [];

			if ($user) 
			{
				$tags = array_filter($json['tags'], function($tag) use ($userId1) {
			    	return in_array($userId1, $tag['users']);
				});
			}
			$tagIds = array_keys($tags);
			// echo $user['username'];
			
			foreach ( $tagIds as $tag )
			{
				
					$member = $squad->addChild('member');
					if ($tag == 1065758)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'PV2 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065759)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'PFC ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065760)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'SPC ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065762)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'CPL ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065763)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'SGT ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065764)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'SSG ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065871)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'SFC ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065765)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'MSG ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065766)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', '1SG ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065767)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'SGM ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065768)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'WO1 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065769)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'CW2 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065771)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'CW3 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065772)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'CW4 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065773)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'CW5 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065774)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', '2LT ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065776)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', '1LT ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1085054)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'MAJ ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1234581)
					{
						$member->addAttribute('id', GetPlayerID($userId1));
						$member->addAttribute('nick', 'LTC ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					break;
					
				}
			$first = false;
		}
		
		$user = isset($json['users'][$userId]) ? $json['users'][$userId] : null;

		$tags = [];

		if ($user) 
		{
			$tags = array_filter($json['tags'], function($tag) use ($userId) {
		    	return in_array($userId, $tag['users']);
			});
		}
		$tagIds = array_keys($tags);
		// echo $user['username'];
		foreach ( $tagIds as $tag )
		{
			
				$member = $squad->addChild('member');
				if ($tag == 1065758)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'PV2 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065759)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'PFC ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065760)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'SPC ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065762)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'CPL ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065763)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'SGT ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065764)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'SSG ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065871)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'SFC ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065765)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'MSG ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065766)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', '1SG ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065767)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'SGM ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065768)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'WO1 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065769)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'CW2 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065771)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'CW3 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065772)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'CW4 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065773)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'CW5 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065774)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', '2LT ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065776)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', '1LT ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1085054)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'MAJ ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1234581)
				{
					$member->addAttribute('id', GetPlayerID($userId));
					$member->addAttribute('nick', 'LTC ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				break;
		}
	}
}

if (file_exists('whiskey.xml'))
{
	unlink('whiskey.xml');
	$xml->asXML('whiskey.xml');
}
else
{
	$xml->asXML('whiskey.xml');
}

Header('Content-type: text/xml');
print($xml->asXML());