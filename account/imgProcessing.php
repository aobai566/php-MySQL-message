
<?php
    $name=$_POST['userName'];
    include('./sql.php');
    $r=mysqli_select_db($link,'userAoBai') or die('选择数据库失败');
    mysqli_set_charset($link,'utf8');

    if($_FILES["file"]["error"]){
        echo"<script>alert('图片过大或图片损坏');window.location.href='javascript:history.go(-1)'</script>";
    }else{
        if(($_FILES["file"]["type"]=="image/png"||$_FILES["file"]["type"]=="image/jpeg")&&$_FILES["file"]["size"]<1024000){
            $dataname=time().$_FILES["file"]["name"];
            $filename ="../userAvatar/".$dataname;
            $filename =iconv("UTF-8","gb2312",$filename);
            if(file_exists($filename)){
                echo"<script>alert('该文件已存在');window.location.href='javascript:history.go(-1)'</script>";
            }else{
                $sql="UPDATE user SET user_head_sculpture='{$filename}' WHERE user_name='{$name}'";
                $result=mysqli_query($link,$sql);
                move_uploaded_file($_FILES["file"]["tmp_name"],$filename);//将临时地址移动到指定地址
                mysqli_close($link);
                echo "<script>window.location.href='javascript:history.go(-1)'</script>";
            }
        }else{
            echo "<script>alert('文件类型不正确');window.location.href='javascript:history.go(-1)'</script>";
        }
    }




?>