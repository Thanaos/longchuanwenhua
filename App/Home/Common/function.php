<?PHP

function getAgeByID($id){

//过了这年的生日才算多了1周岁
    if(empty($id)) return '';
    $date=strtotime(substr($id,6,8));
//获得出生年月日的时间戳
    $today=strtotime('today');
//获得今日的时间戳 111cn.net
    $diff=floor(($today-$date)/86400/365);
//得到两个日期相差的大体年数

//strtotime加上这个年数后得到那日的时间戳后与今日的时间戳相比
    $age=strtotime(substr($id,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;
    
    return $age;
}

//获取会员年费钱数
function getMoneyByAge($age){
    $arr = array(
        1=>array('1'=>990, '2'=>1290, '3'=>1590,'4'=>1990, '6'=>2990),
        2=>array('1'=>990, '2'=>1590, '3'=>2690,'4'=>3900, '6'=>4900),
        3=>array('1'=>2990, '2'=>3900, '3'=>4900 ,'4'=>5900, '6'=>6900),
    );
    
    if($age>=20 && $age<30){
        $key = 1;
    }elseif( $age>=30 && $age<40 ){
        $key = 2;
    }elseif( $age>=40 && $age<50 ){
        $key = 3;
    }elseif( $age>=50 && $age<60 ){
        $key = 4;
    }elseif( $age >60 ){
        $key = 5;
    }else{
        
    }
    $money[1] = $arr[1][$key];
    $money[2] = $arr[2][$key];
    $money[3] = $arr[3][$key];
    return $money;
    
}
