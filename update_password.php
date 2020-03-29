<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "142843827ccq"; //xampp的初始密码为空
$dbname = "forum";

// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);
mysqli_set_charset($conn, "utf8");

// 检测连接
if ($conn->connect_error) {
die("连接失败: " . $conn->connect_error);
}
$post = $_POST;
$new_psw = $post['new_psw'];
$re_new_psw = $post['re_new_psw'];
$god = $_SESSION['god'];

//更新密码
if($new_psw == $re_new_psw){
    $new = md5($new_psw);
    $sql = "UPDATE forum_user SET password = '$new'
WHERE username ='$god' ";
    $conn->query($sql);

  echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("重置成功！");//弹窗提示
        </script>
EOF;

    echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/forum_login2.html"</script>';

}

else{
    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("两次密码不一致！");//弹窗提示
        </script>
EOF;

    echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/verify_for_newcode.html"</script>';


}












?>