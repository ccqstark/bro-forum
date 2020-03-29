<?php
session_start();
$title = "ccq的标题";
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
$id = $_GET["id"];
$result = mysqli_query($conn,"SELECT * FROM article_test2
WHERE id='$id'");

while($row = mysqli_fetch_array($result))
{
     $title = $row['title'];
     $content = $row['content'];
     $author = $row['author'];
     $like_num = $row['like_num'];//点赞量
}
@$god = $_SESSION['god'];
@$_SESSION['article_id'] = $id;
$_SESSION['like_num'] = $like_num;
@$comment_time = $_SESSION['comment_time'];
$id = $_SESSION['article_id'];


$comment_array = array();
$coon = mysqli_connect("180.76.98.154", "root");
mysqli_select_db($coon, "forum");
mysqli_set_charset($coon, "utf8");


$rs = "SELECT * FROM comment_test
WHERE article_id='$id'";
$r = mysqli_query($coon, $rs);
while ($obj = mysqli_fetch_object($r)) {
    $comment_array[] = $obj;
}


echo <<<EOF
<!DOCTYPE html>
<html lang="zh">
<title>blog</title>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Document</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/animate.css" />
	<link rel="stylesheet" href="css/index.css" />
</head>
<body>
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.html" class="navbar-brand">弟弟的blog</a>
			</div>
			<div class="navbar-menu collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="main.php">首页</a></li>
					<li><a href="#">PHP</a></li>
					<li><a href="#">ThinkPHP</a></li>
					<li><a href="#">Laravel</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="write_blog.html">撰写博文</a></li>
				</ul>
				<form action="#" class="navbar-form navbar-right">
					<div class="form-group">
						<input type="text" class="form-control input-sm" id="search" name="search" placeholder="搜索" />
					</div>
					<div class="form-group">
						<button class="btn btn-default btn-sm">搜索</button>
					</div>
				</form>
			</div>
		</div>
	</nav>
<!--文章显示阅读-->	
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8">
				<h1 class="article-title">$title</h1>
				<div class="status">作者：$author
				<div class="status">点赞量：$like_num
				<!--
					<span class="label label-default">PHP</span>
					<span class="label label-default">ThinkPHP</span>
				-->
				</div>
				<div class="article-content">
					<blockquote>
						文章详情
					</blockquote>

					$content
				
                <form action="like_article.php">
                    <div class="form-group pull-right">                      
                        <button type = "submit" class="btn btn-primary">👍点赞</button>											
                    </div>
                </form>
	               
<!--用户评论区-->
				</div>
				<div class="article-comment">
					<div class="page-header"><b>用户评论</b></div>
					<div class="comment-content">
						<form action="comment.php" method="post">
							<div class="form-group">
								<textarea class="form-control" id="comment" name="comment_content" rows="3" cols=""></textarea>
							</div>
							<div class="form-group pull-right">
								<button type = "submit" class="btn btn-primary">发表评论</button>											
							</div>
						</form>
					</div>
					<div class="clearfix"></div>
EOF;
$count = 0;
if($comment_array != '') {
    foreach ($comment_array as $key => $values) {
        if($values->comment_data != '') {
            echo <<<EOF
					<div class="comment-list">
						<div class="comment-list-item">
							<div class="info">$values->commenter<small>$values->comment_time</small></div>
							<div class="content">$values->comment_data</div>
						</div>
					</div>
EOF;
            $count++;
        }

        }
}
if($count == 0)
{
    echo <<<EOF
                    <div class="comment-list">
						<div class="comment-list-item">
							<div class="content">快来抢沙发!</div>
						</div>
					</div>
EOF;
}


echo <<<EOF
			
				
	<div class="footer">
		<p>Copyright 2019 <a href="#">www.hebaodan.com.cn</a> All Rights Reserved</p>
	</div>
	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>


EOF;
?>
