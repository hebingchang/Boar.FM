<?php  
  
function get_lrc($lrc_url){   
    if( $lrc_url ){   
        // Զ�̻�ȡ�������   
        $content = @file_get_contents($lrc_url);   
           
        // �����س����С�������и������   
        $array = explode("\n", $content);   
        $lrc = array();   
  
        foreach($array as $val){   
            // ��������س������С�����   
            $val = preg_replace('/\r/', '', $val);   
               
            // ����ƥ����ʱ��   
            $temp = preg_match_all('/\[\d{2}\:\d{2}\.\d{2}\]/', $val, $matches);   
            if( !empty($matches[0]) ){   
                $data_plus = "";   
                $time_array = array();   
                   
                // ������ƥ��Ķ��ʱ����ѡ���������磺[00:21]��[03:40]   
                foreach($matches[0] as $V){   
                    $data_plus .= $V;   
                    $V = str_replace("[", "", $V);   
                    $V = str_replace("]", "", $V);   
                    $date_array = explode(":", $V);   
                       
                    // �����磺00:21��03:40 ת������   
                    $time_array[] = intval( $date_array[0]*6000 + $date_array[1]*100 );   
                }   
  
                // ������ĵõ���ʱ�䣬���磺[00:21][03:40]���滻�ɿգ��õ����   
                $data_plus = str_replace($data_plus, "", $val);   
                   
                // ��ʱ��͸����ϵ�������   
                foreach($time_array as $V){   
                    $lrc[] = array($V, $data_plus);   
                }   
            }   
        }   
           
        // ��ʱ��˳������������   
        $lrc = bsort($lrc);   
           
        // ��� json��ʽ   
        return json_encode($lrc);   
    }   
    return false;   
}   
  
// ��ʱ��˳������������   
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