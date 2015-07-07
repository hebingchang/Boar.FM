<?php
function curl($url){
         $curl = curl_init();
         curl_setopt($curl,CURLOPT_URL,$url);
         curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
         curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,10);
         curl_setopt ($curl, CURLOPT_REFERER, "http://music.163.com/");
         curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_0 like Mac OS X; en-us) AppleWebKit/532.9 (KHTML, like Gecko) Version/4.0.5 Mobile/8A293 Safari/6531.22.7");
         $src = curl_exec($curl);
         curl_close($curl);    
         return $src;
}
	$listurl='http://music.163.com/api/playlist/detail?id=83830475&updateTime=-1';
	$listcon=curl($listurl,''); 
	$listjson=json_decode($listcon,true);
	$fmcount=$listjson['result']['trackCount'];
	$nowplaying=$_GET['now'];
	for ($x=0; $x<$fmcount; $x++) {
		$songs[$x]=$listjson['result']['tracks'][$x]['id'];
        if ($listjson['result']['tracks'][$x]['id'] == $nowplaying) {
            $retind=$x+1;
        }
	}
	if ($retind == $x) {
        $retind=0;
    }
	if ($nowplaying == "") {
    	$retind=rand(0,$fmcount-1);
    }
	echo "<script language='javascript' type='text/javascript'>";  
	echo "window.location.href='./?id=" . $songs[$retind] . "'";  
	echo "</script>"; 
?>