<?php
function search($a,$keywords) {
    $arr=$result=array();
    foreach ($a as $key => $value) {
        foreach ($value as $valu) {
            if(strstr($valu, $keywords) !== false){
                array_push($arr, $key);
            }
        }
    }
    foreach ($arr as $key => $value) {
        if(array_key_exists($value,$a)){
            array_push($result, $a[$value]);
        }
    }
    return $result;
}

function object_to_array($obj) {
    $obj = (array)$obj;
    foreach ($obj as $k => $v) {
        if (gettype($v) == 'resource') {
            return;
        }
        if (gettype($v) == 'object' || gettype($v) == 'array') {
            $obj[$k] = (array)object_to_array($v);
        }
    }
    
    return $obj;
}
function hidemainword($str,$staywords,$end=true){//隐藏关键字
    $strlenth=mb_strlen($str,"utf-8");
    $strmain="";
    for ($c=0;$c<$strlenth-$staywords;$c++){
        $strmain.="*";
    }
    if ($end){
        return $strmain.mb_substr($str, $strlenth-$staywords,$strlenth,"utf-8");
        
    }else{
        return mb_substr($str, 0,$staywords,"utf-8").$strmain;
       
    }
   
    
}
//获取中文字符串的拼音首字母字符串
function getfirstchar($s0){
    $fchar = ord($s0{0});
    if($fchar >= ord("A") and $fchar <= ord("z") )return strtoupper($s0{0});
    $s1 = @iconv("UTF-8","gb2312", $s0);
    $s2 = @iconv("gb2312","UTF-8", $s1);
    if($s2 == $s0){$s = $s1;}else{$s = $s0;}
    $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
    if($asc >= -20319 and $asc <= -20284) return "A";
    if($asc >= -20283 and $asc <= -19776) return "B";
    if($asc >= -19775 and $asc <= -19219) return "C";
    if($asc >= -19218 and $asc <= -18711) return "D";
    if($asc >= -18710 and $asc <= -18527) return "E";
    if($asc >= -18526 and $asc <= -18240) return "F";
    if($asc >= -18239 and $asc <= -17923) return "G";
    if($asc >= -17922 and $asc <= -17418) return "H";
    if($asc >= -17922 and $asc <= -17418) return "I";
    if($asc >= -17417 and $asc <= -16475) return "J";
    if($asc >= -16474 and $asc <= -16213) return "K";
    if($asc >= -16212 and $asc <= -15641) return "L";
    if($asc >= -15640 and $asc <= -15166) return "M";
    if($asc >= -15165 and $asc <= -14923) return "N";
    if($asc >= -14922 and $asc <= -14915) return "O";
    if($asc >= -14914 and $asc <= -14631) return "P";
    if($asc >= -14630 and $asc <= -14150) return "Q";
    if($asc >= -14149 and $asc <= -14091) return "R";
    if($asc >= -14090 and $asc <= -13319) return "S";
    if($asc >= -13318 and $asc <= -12839) return "T";
    if($asc >= -12838 and $asc <= -12557) return "W";
    if($asc >= -12556 and $asc <= -11848) return "X";
    if($asc >= -11847 and $asc <= -11056) return "Y";
    if($asc >= -11055 and $asc <= -10247) return "Z";
    return NULL;
    //return $s0;
}
function pinyin_long($zh){  //获取整条字符串所有汉字拼音首字母
    $ret = "";
    $s1 = iconv("UTF-8","gb2312", $zh);
    $s2 = iconv("gb2312","UTF-8", $s1);
    if($s2 == $zh){$zh = $s1;}
    for($i = 0; $i < strlen($zh); $i++){
        $s1 = substr($zh,$i,1);
        $p = ord($s1);
        if($p > 160){
            $s2 = substr($zh,$i++,2);
            $ret .= getfirstchar($s2);
        }else{
            $ret .= $s1;
        }
    }
    return $ret;
}
//对比两个二维数组的差值
function array_diff_assoc2_deep($array1, $array2) {
    $ret = array();
    foreach ($array1 as $k => $v) {
        if (!isset($array2[$k])) $ret[$k] = $v;
        else if (is_array($v) && is_array($array2[$k])) $ret[$k] = array_diff_assoc2_deep($v, $array2[$k]);
        else if ($v !=$array2[$k]) $ret[$k] = $v;
        else
        {
            unset($array1[$k]);
        }
        
    }
    return array_filter($ret);
} 

function statebetext($state){
    switch ($state){
        case "1":
            return "<a style='color:green'>开启</a>";
            break;
        case "2":
            return "<a style='color:red'>关闭</a>";
            break;
    }
}
//发送post请求
function send_post($url, $post_data) {
    
    
    
    $postdata = http_build_query($post_data);
    
    $options = array(
        
        'http' => array(
            
            'method' => 'POST',
            
            'header' => 'Content-type:application/x-www-form-urlencoded',
            
            'content' => $postdata,
            
            'timeout' => 15 * 60 // 超时时间（单位:s）
            
        )
        
    );
    
    $context = stream_context_create($options);
    
    $result = file_get_contents($url, false, $context);
    
    
    
    return $result;
    
}