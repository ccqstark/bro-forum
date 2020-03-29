<?php
session_start();
$article_time = date('Y-m-d H:i:s', time());
$_SESSION['$article_time'] = $article_time;
$god = $_SESSION['god'];

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
$zero = 0;
$sql = "INSERT INTO article_test2(author,title,content,article_time,like_num)
    VALUES ('$god','$_POST[title]','$_POST[content]','$article_time','$zero ')";

//发表博文
if ($conn->query($sql) === TRUE) {
    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("发表成功！");//弹窗提示
        </script>
EOF;
    echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/main.php"</script>';
    //回到主页

}


$conn->close();

?>



