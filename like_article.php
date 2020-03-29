<?php
session_start();
$post = $_POST;
$like_num = $_SESSION['like_num'];
$like_num = $like_num + 1;

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

$god = $_SESSION["god"];
$article_id = $_SESSION['article_id'];
$flag = 0;
$like_array = array();

$rs = "SELECT * FROM like_article
WHERE article_id='$article_id'";
$r = mysqli_query($conn, $rs);
while ($obj = mysqli_fetch_object($r)) {
    $like_array[] = $obj;
}
foreach ($like_array as $key=>$values){
     if($values->username==$god){
         $flag = 1;
     }
}

//未点赞过的用户可以进行点赞
if($flag == 0)
{
    $sql1 = "INSERT INTO like_article(username,article_id)
    VALUES ('$god','$article_id')";
    $sql2 = "UPDATE article_test2 SET like_num = '$like_num'
WHERE id='$article_id' ";
    $conn->query($sql1);
    $conn->query($sql2);


    echo <<<EOF
        <script language=javascript>window.location.href="http://180.76.98.154/winter_camp/echo_article.php?id=$article_id"</script>
EOF;

}
//判断不能重复点赞
else{
    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("弟弟你已经点赞过了！");//弹窗提示
        </script>
EOF;
    echo <<<EOF
        <script language=javascript>window.location.href="http://180.76.98.154/winter_camp/echo_article.php?id=$article_id"</script>
EOF;

}

?>