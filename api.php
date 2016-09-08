<?php
$enjinuid = 871957;
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_URL, 'http://21starmyrangers.enjin.com/api/get-tags');
// $result = curl_exec($ch);
// curl_close($ch);
$result = file_get_contents('http://21starmyrangers.enjin.com/api/get-tags');

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
$Dev = $json['tags']['1327667']['users'];




if (in_array($enjinuid, $Dev))
         {
          echo 'True';
         }

// echo '<pre>';
// var_dump($Dev );
// echo '</pre>';
