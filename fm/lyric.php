<?php
	function lyrictrans($lyric){
		$lyric = substr($lyric,1);
		xh:
			$left = strpos($lyric, '[');
			$right = strpos($lyric, ']');
			$time = substr($lyric,0,$right);
			if ($left!="") {
				$text = substr($lyric,$right+1,$left-$right-2);
			} else {
				$text = strrev(substr(strrev(substr($lyric,$right+1)),1));
			}
			$result = $result . "lyric.add_lrc('" . time2time($time) . "', " . '"' . $text . '");' ;
			$lyric = substr($lyric,$left+1);
		if ($left!="") {goto xh;}
		return $result;
	}
	function time2time($time){
		$time1=substr($time,0,2);
		$time2=substr($time,3,2);
		$time3=substr($time,6,2);
		$res=$time1*60+$time2+$time3/100;
		if ($res==0) {$res=0.01;}
		return $res;
	}
?>