
<?php
header("Content-type: text/html; charset=utf-8");
function information(){
    $f='../logs/loginInformation.log'; //文件名
    $ac=file($f); //把文件的所有内容获取到数组里面
    $file=fopen($f,'a');
    $text=$_POST['text'];
    $data=date('Y-m-d h:i:s', time());
    $ac=$text.'在 '.$data." 登陆了页面";
    fwrite($file,$ac."\r\n");
    fclose($file);
}
$VarText=0;
$nameList=null;
$name=$_POST['text'];
$password=$_POST['password'];
if(isset($name)&& isset($_POST['password'])){
    if($name!=''){
        if($password!=''){
            include('./sql.php');
            mysqli_select_db($link,'userAobai') or die('选择数据库失败');
            mysqli_set_charset($link,'utf8');
            $sql2="SELECT * FROM user";
            $result2=mysqli_query($link,$sql2);
            $sql="SELECT * FROM user WHERE user_name='{$name}'";
            $result3=mysqli_query($link,$sql);
            while($row=mysqli_fetch_assoc($result3)){
                if($row['user_password']==$password){
                    $VarText=1;
                }else{
                    echo "<script>alert('密码不正确');window.location.href='javascript:history.go(-1)'</script>";
                    return false;
                }
            }

            if($VarText==1){
                //go on
                information();
            }else{echo "<script>alert('用户名不存在，请注册');window.location.href='javascript:history.go(-1)'</script>";return false;}
        }else{echo "<script>alert('信息不完整');window.location.href='javascript:history.go(-1)'</script>";return false;}
    }else{echo "<script>alert('信息不完整');window.location.href='javascript:history.go(-1)'</script>";return false;}
}else{echo '啥呀你这是，别人给你的链接你都敢点（斜眼笑）<br>'; echo '不逗你了。' ;echo '<a href="yyab.top">点我重新登录<a>';return false;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>交流平台—羊一傲白</title>
</head>
<?php
            include('./sql.php');
            mysqli_select_db($link,'userAoBai') or die('选择数据库失败');
            mysqli_set_charset($link,'utf8');
            $sql2="SELECT * FROM user";
            $result2=mysqli_query($link,$sql2);
            $sql="SELECT * FROM user WHERE user_name='{$name}'";
            $result3=mysqli_query($link,$sql);
            while($row=mysqli_fetch_assoc($result3)){
                $user_head_sculpture=$row['user_head_sculpture'];
                if($row['user_head_sculpture']==''){
                    $user_head_sculpture="../userAvatar/default.png";
                }else{$user_head_sculpture=$user_head_sculpture;}
            }
?>
<body>
    <div id="container">
        <div id="header">
            <div id="replaceImg_postion"></div>
            <p>请不断<spen style="color:yellow;">刷新界面(F5)</spen>以获得最新消息</p>
            <img src="<?php echo($user_head_sculpture);?>" title="选择头像" id="image-head" onclick="replaceImg()">
            <div>
                <spen id="">我的名字：<?php echo $_POST['text'];?>
                
            </div>
            <form action="Send.php" method="post">
                <input type="text" hidden='hidden' name='userName' value=<?php echo $_POST['text'] ?>>
                <input type="text" name="text" id="text" placeholder="请输入发送的信息">
                <button id="sending" type="submit">发送</button>
            </form>
        </div>
        <div id='a1'></div>
        <div id="footer">
            
            <?php
                mysqli_select_db($link_message,'userAoBai') or die('选择数据库失败');
                mysqli_set_charset($link_message,'utf8');
                $sql="SELECT * FROM message";
                $result=mysqli_query($link,$sql);
                
                while ($row=mysqli_fetch_assoc($result)) {
                    mysqli_select_db($link_message,'userAoBai') or die('选择数据库失败');
                    mysqli_set_charset($link_message,'utf8');
                    $sql_img="SELECT * FROM user";
                    $result_img=mysqli_query($link,$sql_img);
                    while($row2=mysqli_fetch_assoc($result_img)){
                        if($row2['user_name']==$row['user_name']){
                            if($row2['user_head_sculpture']==''){
                                $user_head_sculpture="../userAvatar/default.png";
                            }else{$user_head_sculpture=$row2['user_head_sculpture'];}
                        }
                    }
                    echo "<div id='div'>";
                        echo "<div style='display: flex;'>";
                            echo "<div id='name'>";
                            echo "<img src=".$user_head_sculpture." style='width:30px;height:30px;'><img>";
                                echo $row['user_name'];
                                echo '：';
                            echo "</div>";
                            echo "<div id='Data'>";
                            echo $row['user_data'];
                            echo "</div>";
                        echo "</div>";
                        echo "<div id='message'>";
                        echo $row['user_text'];
                        echo "</div>";
                    echo "</div>";
                }
                mysqli_close($link);
            ?>  
        </div>
    </div>
</body>
</html>
<script>
    var headImg=document.getElementById('headImg');
    var replaceImg_postion=document.getElementById('replaceImg_postion')
    function replaceImg(){
        replaceImg_postion.innerHTML="<div id='img1'><div id='cancel'></div><form action='imgProcessing.php' method='post' enctype='multipart/form-data'><input type='text' hidden='hidden' name='userName' value=<?php echo $_POST['text'] ?>><input type='file' name='file' id='file'><input type='submit' id='submitdImg' value='提交头像'></spen></form><div>"
    }
</script>
<style>
    *{
        padding: 0;
        margin: 0;
        word-break:break-all;
    }
    #header button{
        width: 30vh;
    }
    #container{
        display: flex;
        flex-direction: row;
    }
    #header{
        display: flex;
        height: 100vh;
        flex: 1;
        background-color: #000;
        background-color: #188eee;
        background-image: url(http://coding.imweb.io/img/project/resume/bg.png);
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-right:10px solid black;
    }
    #footer{
        flex: 1;
    }
    #text{
        display: flex;
        flex-direction: column;
        height: 18.54vh;
        width: 30vh;
    }
    #div{
        height: auto;
        border:10px solid #188eee;
        display: flex;
        flex-direction: column;
        padding:10px;
        border-bottom:10px solid #fff;
        border-radius:10px;
    }
    #Data{
        position: relative;
        left: 0%;
        transform: translate(0,0);
    }
    #a1{
        display:flex;
        flex:0.025;
        background-color: black;
    }
    #image-head{
        position: relative;
        /* background-color:black; */
        display:flex;
        width: 10vw;
        height: 10vw;
        background-size: 100%;
        background-repeat: no-repeat;
        border-radius: 50%;
    }
    #img1{
        display: flex;
        position: absolute;
        border:1px solid gray;
        width:50vw;
        height:50vh;
        margin: 0 auto;
        background-color: white;
        z-index:100;
    }
    #img1 #file,#img1 #submitdImg{
        display: flex;
        flex-direction: column;
        position: relative;
        left: 50%;
        border:1px solid gray;
        text-align: center;
        background-color: white;
        z-index:101;
    }
    #img1 #cancel{
        position: relative;
        left: 100%;
        transform: translate(-100%);
        background-color: red;
        width: 2rem;
        height: 2rem;
    }
    #img1 #cancel::before{
        left:0.5rem;
        content:'×';
        font-size: 2rem;
    }
    #img1 #submitdImg{

    }
    @media screen and (max-width: 768px){
        #container {            /*响应式布局*/
            display: flex;
            flex-direction: column;
        }
        #img1{
            top:10vh;
            left:10vw;
            width:80vw;
            height:50vh;
        }
        #img1 #file,#img1 #submitdImg{
            left:0;
        }
    }
    @media screen and (min-width: 768px){
        #container {            /*响应式布局*/
            display: flex;
            flex-direction: row;
        }
    }
</style>