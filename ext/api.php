<?php

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_URL, 'http://21starmyrangers.enjin.com/api/get-tags');
// $result = curl_exec($ch);
// curl_close($ch);
// 


$result = file_get_contents('21st.json');
$json = json_decode($result,true);


$tags = $json['tags'];
$SFC = $json['tags']['1065871']['users'];
$MSG = $json['tags']['1065765']['users'];
$FSG = $json['tags']['1065766']['users'];
$SGM = $json['tags']['1065767']['users'];
$SLT = $json['tags']['1065774']['users'];
$FLT = $json['tags']['1065776']['users'];
$MAJ = $json['tags']['1085054']['users'];
$LTC = $json['tags']['1234581']['users'];
$RRD = $json['tags']['1518730']['users'];
$TOC = $json['tags']['1092531']['users'];
$RRDLead = $json['tags']['1656129']['users'];
$GLead = $json['tags']['1217502']['users'];
$NLead = $json['tags']['1167334']['users'];
$VLead = $json['tags']['1167327']['users'];
$WLead = $json['tags']['1167327']['users'];
$Viking = $json['tags']['1065785']['users'];
$Dev = $json['tags']['1327667']['users'];

$xml = new SimpleXMLElement('<xml/>');
$squad = $xml->addChild('squad');
$squad->addAttribute('nick', '2nd');
$squad->addChild('name', '2nd Platoon "Viking"');
$squad->addChild('email','21stusarmyrangers@gmail.com');
$squad->addChild('web','http://21starmyrangers.enjin.com/viking');
$squad->addChild('picture','624141a59e2fa0dfe0225e4a9531cc31.paa');
$squad->addChild('title','2nd Platoon "Viking" / 21st Ranger Regiment');
$first = true;
foreach ( $Viking as $userId )
{
	
		foreach ( $VLead as $userId1 )
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
						$member->addAttribute('nick', 'PV2 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065759)
					{
						$member->addAttribute('nick', 'PFC ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065760)
					{
						$member->addAttribute('nick', 'SPC ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065762)
					{
						$member->addAttribute('nick', 'CPL ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065763)
					{
						$member->addAttribute('nick', 'SGT ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065764)
					{
						$member->addAttribute('nick', 'SSG ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065871)
					{
						$member->addAttribute('nick', 'SFC ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065765)
					{
						$member->addAttribute('nick', 'MSG ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065766)
					{
						$member->addAttribute('nick', '1SG ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065767)
					{
						$member->addAttribute('nick', 'SGM ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065768)
					{
						$member->addAttribute('nick', 'WO1 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065769)
					{
						$member->addAttribute('nick', 'CW2 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065771)
					{
						$member->addAttribute('nick', 'CW3 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065772)
					{
						$member->addAttribute('nick', 'CW4 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065773)
					{
						$member->addAttribute('nick', 'CW5 ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065774)
					{
						$member->addAttribute('nick', '2LT ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1065776)
					{
						$member->addAttribute('nick', '1LT ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1085054)
					{
						$member->addAttribute('nick', 'MAJ ' . $user['username']);
						$member->addChild('name', $user['username']);
						$member->addChild('email', 'N/A');
						$member->addChild('icq', 'N/A');
						$member->addChild('remark', 'N/A');
					}
					elseif ($tag == 1234581)
					{
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
					$member->addAttribute('nick', 'PV2 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065759)
				{
					$member->addAttribute('nick', 'PFC ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065760)
				{
					$member->addAttribute('nick', 'SPC ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065762)
				{
					$member->addAttribute('nick', 'CPL ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065763)
				{
					$member->addAttribute('nick', 'SGT ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065764)
				{
					$member->addAttribute('nick', 'SSG ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065871)
				{
					$member->addAttribute('nick', 'SFC ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065765)
				{
					$member->addAttribute('nick', 'MSG ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065766)
				{
					$member->addAttribute('nick', '1SG ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065767)
				{
					$member->addAttribute('nick', 'SGM ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065768)
				{
					$member->addAttribute('nick', 'WO1 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065769)
				{
					$member->addAttribute('nick', 'CW2 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065771)
				{
					$member->addAttribute('nick', 'CW3 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065772)
				{
					$member->addAttribute('nick', 'CW4 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065773)
				{
					$member->addAttribute('nick', 'CW5 ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065774)
				{
					$member->addAttribute('nick', '2LT ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1065776)
				{
					$member->addAttribute('nick', '1LT ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1085054)
				{
					$member->addAttribute('nick', 'MAJ ' . $user['username']);
					$member->addChild('name', $user['username']);
					$member->addChild('email', 'N/A');
					$member->addChild('icq', 'N/A');
					$member->addChild('remark', 'N/A');
				}
				elseif ($tag == 1234581)
				{
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



Header('Content-type: text/xml');
print($xml->asXML());

// echo '<squad nick="2nd">
// <name>2nd Platoon "Viking"</name>
// <email>21stusarmyrangers@gmail.com</email>
// <web>http://21starmyrangers.enjin.com/viking</web>
// <picture>624141a59e2fa0dfe0225e4a9531cc31.paa</picture>
// <title>2nd Platoon "Viking" / 21st Ranger Regiment</title>';

// foreach ($Viking as $userId )
// {
// 	$user = isset($json['users'][$userId]) ? $json['users'][$userId] : null;

// 	$tags = [];

// 	if ($user) {
//     	$tags = array_filter($json['tags'], function($tag) use ($userId) {
//         	return in_array($userId, $tag['users']);
//     	});
// 	}
// 	$tagIds = array_keys($tags);
// 	// echo $user['username'];
// 	foreach ( $tagIds as $tag )
// 	{
// 		// echo '<pre>';
// 		// var_dump($tag);
// 		// echo '</pre>';
// 		if ($tag == 1065763)
// 			{
// 				echo $user['username'];
// 				echo 'Sergeant <br />';
// 			}
// 			elseif ($tag == 1065760)
// 			{
// 				echo $user['username'];
// 				echo 'Specialist <br />';
// 			}
		
		

// 	}
// }



// echo $user['username'];
// foreach ( $tagIds as $tag )
// {
// 	echo '<pre>';
// 	var_dump($tag);
// 	echo '</pre>';
// 	// foreach( $tags["{$tag}"] as $name )
// 	// {
// 	// 	foreach ($name as $new )
// 	// 	{
// 	// 		echo $new;
// 	// 	}
// }
// 	foreach ($tags["{$tag}"]['users'] as $user1)
// 	{

// 	if ( $user1 == $userId)
// 	{
// 	echo 'True';
// }
// }
	
