<?php  
  
function get_lrc($lrc_url){   
    if( $lrc_url ){   
        // 远程获取歌词内容   
        $content = @file_get_contents($lrc_url);   
           
        // 按”回车换行“将歌词切割成数组   
        $array = explode("\n", $content);   
        $lrc = array();   
  
        foreach($array as $val){   
            // 清除掉”回车不换行“符号   
            $val = preg_replace('/\r/', '', $val);   
               
            // 正则匹配歌词时间   
            $temp = preg_match_all('/\[\d{2}\:\d{2}\.\d{2}\]/', $val, $matches);   
            if( !empty($matches[0]) ){   
                $data_plus = "";   
                $time_array = array();   
                   
                // 将可能匹配的多个时间挑选出来，例如：[00:21]、[03:40]   
                foreach($matches[0] as $V){   
                    $data_plus .= $V;   
                    $V = str_replace("[", "", $V);   
                    $V = str_replace("]", "", $V);   
                    $date_array = explode(":", $V);   
                       
                    // 将例如：00:21、03:40 转换成秒   
                    $time_array[] = intval( $date_array[0]*6000 + $date_array[1]*100 );   
                }   
  
                // 将上面的得到的时间，例如：[00:21][03:40]，替换成空，得到歌词   
                $data_plus = str_replace($data_plus, "", $val);   
                   
                // 将时间和歌词组合到数组中   
                foreach($time_array as $V){   
                    $lrc[] = array($V, $data_plus);   
                }   
            }   
        }   
           
        // 按时间顺序来排序数组   
        $lrc = bsort($lrc);   
           
        // 输出 json格式   
        return json_encode($lrc);   
    }   
    return false;   
}   
  
// 按时间顺序来排序数组   
function bsort(array $array){   
    $count = count($array);     
    for($i=0; $i<$count; $i++){   
        for($j=$count-1; $j>$i; $j--){   
            if($array[$j][0] < $array[$j-1][0]){   
                $temp = $array[$j];     
                $array[$j] = $array[$j-1];     
                $array[$j-1] = $temp;     
            }     
        }     
    }     
    return $array;   
}   
  
echo get_lrc('http://img.xiami.net/lyric/upload/80/1962480_1353992330.lrc');   
  
?>