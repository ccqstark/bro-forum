<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "142843827ccq"; //xampp的初始密码为空
$dbname = "forum";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$post = $_POST;
$user = $post["username"];
$_SESSION['god'] = $post["username"];

//查询此用户是否存在
$flag = 0;
$rs = "SELECT * FROM forum_user
WHERE username = '$user'";
$r = mysqli_query($conn, $rs);
$user_array[] = array();
while ($obj = mysqli_fetch_object($r)) {
    $user_array[] = $obj;
}
foreach ($user_array as $key=>$values){
    if(@$values->username==$user){
        $flag = 1; //找到用户
    }
}


//用户存在
if($flag == 1) {
    $verify_psw_sql = "SELECT * FROM forum_user
WHERE username = '$user'";
    $result = mysqli_query($conn, $verify_psw_sql);
    while ($row = mysqli_fetch_array($result)) {
        $psw = $row['password'];
    }

    $import_psw = md5($post['password']);//把用户输入的密码进行加密
   // 比较加密后的密码是否正确
    if($psw == $import_psw)
    {
         echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/main.php"</script>';
        //跳转到主页面
    }
    //密码错误
    else{
        echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("密码错误！请重新输入！");
        </script>
EOF;
        //跳回页面
        echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/forum_login2.html"</script>';

    }

}


//用户不存在
elseif($flag == 0){
    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
          window.alert("此弟弟不存在！");
          </script>
EOF;
    echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/forum_login2.html"</script>';
}

?>