<?php
    header("Content-type: text/html; charset=utf-8");
    $text=$_POST['text'];
    $user_name=$_POST['userName'];
    $data=date('Y-m-d h:i:s', time());
    $characterList=array("<script>","</script>","<?php","?>");
    $numb=0;

    include('./sql.php');
    mysqli_select_db($link,'userAoBai') or die('选择数据库失败');
    mysqli_set_charset($link,'utf8');
    if($text!=''){
        for($num=0;$num<count($characterList);$num++){
            if(strpos($text,$characterList[$num])!==false){
                $illegalCharacter=str_replace($characterList[$num],'',$text);
                $text=$illegalCharacter;
                $numb=1;
            }
        }
            $sql="INSERT INTO message( user_text , user_name , user_data ) VALUES('{$text}','{$user_name}','{$data}')";
            mysqli_query($link,$sql);
            mysqli_close($link);
    }else{
        echo "<script>alert('值不能为空')</script>";
    }
?>
<script>
    window.location.href="javascript:history.go(-1)"
</script>