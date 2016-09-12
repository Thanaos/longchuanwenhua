<?PHP
/* 获取基础的option */
function getOption($arr, $option){
    foreach( $arr as $v ){
        if( $option ){
            $str .= '<option value="'.$v['id'].'" selected>'.$v['value'].'</option>';
        }else{
            $str .= '<option value="'.$v['id'].'">'.$v['value'].'</option>';
        }
    }
    return $str;
}

/* 获取单个值 */
function getValue($arr, $option){
    foreach( $arr as $v ){
        if( $v['id'] = $option ){
            $str = $v['value'];
        }
    }
    return $str;
}

/* 获取身高资料 */
function getOptionHeight(){
    $str = '';
    for($start=130; $start<=200; $start++){
        $str .= '<option value="'.$start.'">'.$start.'厘米</option>';
    }
    return $str;
}

/* 获取学历信息 */
function getOptionEducation($option , $list = true){

    $arr = array( 
        array('id'=>1, 'value'=>'中专'),
        array('id'=>2, 'value'=>'高中及以下'),
        array('id'=>3, 'value'=>'大专'),
        array('id'=>4, 'value'=>'大学本科'),
        array('id'=>5, 'value'=>'硕士'),
        array('id'=>6, 'value'=>'博士'),
    );
    if( $list ){
        $str = getOption($arr, $option);
    }else{
        $str = getValue($arr, $option);
    }

    return $str;

    
}

/* 获取月收入信息 */
function getOptionIncome( $option, $list = true ){
    $arr = array(
        array('id'=>1, 'value'=>'1000元以下'),
        array('id'=>2, 'value'=>'1000-2000'),
        array('id'=>3, 'value'=>'2001-3000'),
        array('id'=>4, 'value'=>'3001-5000'),
        array('id'=>5, 'value'=>'5001-8000'),
        array('id'=>6, 'value'=>'8001-10000'),
        array('id'=>7, 'value'=>'10001-20000'),
        array('id'=>8, 'value'=>'20001-50000'),
        array('id'=>9, 'value'=>'50000元以上'),
    );

    if( $list ){
        $str = getOption($arr, $option);
    }else{
        $str = getValue($arr, $option);
    }

    return $str;

} 
