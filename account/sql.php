<?php
// 请先配置好数据表结构，文件在sqlfile.txt内
// 数据库
$name='xxx';              // 用户名
$password='xxx';      // 密码


$link = mysqli_connect('localhost',$name,$password) or die('连接数据库失败');
$link_message = mysqli_connect('localhost',$name,$password) or die('连接数据库失败');