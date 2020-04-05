<?php
session_start();
// 存储 session 数据

$servername = "localhost";
$username = "root";
$password = "142843827ccq"; //xampp的初始密码为空
$dbname = "forum";
$god = $_SESSION['god'];

date_default_timezone_set('PRC');
$comment_time = date('Y-m-d H:i:s', time());
$_SESSION['comment_time'] = $comment_time;

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$comment_content = $_POST['comment_content'];
$article_id = $_SESSION['article_id'];
$flag = 1;
//评论判空
if($comment_content == '') {
    $flag = 0;
    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("评论不能为空喔！");//弹窗提示
        </script>

EOF;
    echo <<<EOF
    <script language=javascript>window.location.href = "echo_article.php?id=$article_id"</script>;
EOF;
}

//插入评论数据
if($flag == 1) {
    $sql = "INSERT INTO comment_test(commenter,comment_data,article_id,comment_time)
    VALUES ('$god','$comment_content' ,'$article_id','$comment_time')";
    $conn->query($sql);
    $conn->close();
}

echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("评论成功！");//弹窗提示
        </script>
EOF;

echo <<<EOF
<script language=javascript>window.location.href = "echo_article.php?id=$article_id"</script>;
EOF;



