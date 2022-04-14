<?php
    header("Content-type: text/html; charset=utf-8");
    $ab = 0;
    $name=$_POST['text'];
    $email=$_POST['email'];
    if($name!=""&&$email!=""&&$_POST['password1']!=""&&$_POST['password2']!=""){
        if($_POST['password1']==$_POST['password2']){
                $password=$_POST['password1'];
                include('./sql.php');
                mysqli_select_db($link,'userAoBai') or die('选择数据库失败');
                mysqli_set_charset($link,'utf8');
                $sql2="SELECT * FROM user";
                $result2=mysqli_query($link,$sql2);
                if($result2 && mysqli_num_rows($result2)>0){
                    while($row=mysqli_fetch_assoc($result2)){
                        if($row['user_name']==$name){
                            $ab=1;
                        }
                    }
                }
                if($ab==0){
                    $sql="INSERT INTO user(user_name,user_email,user_password) VALUES('{$name}','{$email}','{$password}')";
                    $result=mysqli_query($link,$sql);
                    if($result && mysqli_affected_rows($link)>0){
                        echo "<script>alert('注册成功');window.location.href='javascript:history.go(-1)'</script>";
                    }else{
                        echo "<script>alert('注册失败');window.location.href='javascript:history.go(-1)'</script>";
                    }
                    
                }else{
                    echo "<script>alert('用户名重复');window.location.href='javascript:history.go(-1)'</script>";
                    exit;
                }
                return false;
        }else{echo("<script>alert('确认密码不正确');window.location.href='javascript:history.go(-1)'</script>");}
    }else{echo("<script>alert('请填写完整');window.location.href='javascript:history.go(-1)'</script>");};
