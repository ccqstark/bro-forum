<?php
session_start();

@$god = $_SESSION['god'];
$servername = "localhost";
$username = "root";
$password = "142843827ccq";
$dbname = "forum";
// 创建连接
$conn = mysqli_connect($servername, $username, $password,$dbname);
mysqli_set_charset($conn, "utf8");

// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//分页的函数
function news($pageNum = 1 , $pageSize = 4)
{
    $array = array();
    $coon = mysqli_connect("localhost", "root",'142843827ccq');
    mysqli_select_db($coon, "forum");
    mysqli_set_charset($coon, "utf8");

    $rs = "select * from article_test2 limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;//本页显示的4篇文章
    $r = mysqli_query($coon, $rs);
    while ($obj = mysqli_fetch_object($r)) {
        $array[] = $obj;
    }
    mysqli_close($coon,"forum");
    return $array;

}


//显示总文章数的函数
function allNews()
{
    $coon = mysqli_connect("localhost", "root",'142843827ccq');
    mysqli_select_db($coon, "forum");
    mysqli_set_charset($coon, "utf8");
    $rs = "select count(*) num from article_test2"; //可以显示出总页数
    $r = mysqli_query($coon, $rs);
    $obj = mysqli_fetch_object($r);
    mysqli_close($coon,"forum");
    return $obj->num;
}


@$allNum = allNews();
@$pageSize = 4; //约定每页显示几条信息
@$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
@$endPage = ceil($allNum/$pageSize); //总页数
@$array = news($pageNum,$pageSize);//获取到本页的文章



echo <<<EOF
<!DOCTYPE html>
<html lang="zh">
<title>弟弟论坛</title>
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
            <a href="#" class="navbar-brand">弟弟论坛的blog们</a>
        </div>
        <div class="navbar-menu collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="main.php">首页</a></li>
                <li><a href="#">PHP</a></li>
                <li><a href="#">ThinkPHP</a></li>
                <li><a href="#">Laravel</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="forum_login2.html">登录</a></li>
                <li><a href="forum_register2.html">注册</a></li>
                <li><a href="write_blog.html">撰写博文</a></li>
                <li><a href="#">$god</a></li>
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
<div class="container">
    <div class="jumbotron">
        <h1 class="animated fadeInDown">弟弟论坛</h1>
        <p class="animated shake">弟弟论坛是所有弟弟的聚集地，是全国最大的弟弟交♂友网站</p>
        <h2 class="animated fadeInUp">+我V信：<a href="" target="_blank">ccq_权 看妹妹最新*片</a></h2>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="page-header h3">博文列表</div>
            <div class="article-list">
EOF;


                foreach($array as $key=>$values){
                echo <<<EOF
                <div class="article-list-item">
                    <a href="echo_article.php?id=$values->id" class="title">$values->title</a>
                    <div class="info">
                        <span class="author">作者: $values->author</span>
                        <span class="time">发布时间：$values->article_time</span> 
                    </div>
                </div>
EOF;
              }

$last_page = $pageNum - 1;
$next_page = $pageNum + 1;
echo <<<EOF
 <!--下面的检索栏（分页）-->           
           </div>                 
               <nav class="">
					<ul class="pagination"> 				
						<li class="disabled"><li><a href="main.php?pageNum=$last_page">&laquo;</a></li>
						<li class="active">
EOF;
//蓝色标注当前页数
						if($pageNum != 1) {
                            echo '<li>';
                        }
						echo '<a href="main.php?pageNum=1">1</a></li>';
                        echo  '<li class="active">';
                        if($pageNum != 2) {
                            echo '<li>';
                        }
						echo'<a href="main.php?pageNum=2">2</a></li>';

                        echo  '<li class="active">';
                        if($pageNum != 3) {
                            echo '<li>';
                        }
                        echo'<a href="main.php?pageNum=3">3</a></li>';

                        echo  '<li class="active">';
                        if($pageNum != 4) {
                            echo '<li>';
                        }
                        echo'<a href="main.php?pageNum=4">4</a></li>';

                        echo  '<li class="active">';
                        if($pageNum != 5) {
                            echo '<li>';
                        }
                        echo'<a href="main.php?pageNum=5">5</a></li>';

echo <<<EOF
						<li class="disabled"><li><a href="main.php?pageNum=$next_page">&raquo;</a></li>						
					</ul>
				</nav>

         </div>
 <!--侧栏推荐文章-->                  
        <div class="col-sm-12 col-md-4">
            <div class="page-header h3">推荐文章</div>
            <div class="topic-list">
                <div class="topic-list-item">
                    <a href="echo_article.php?id=1" class="title">三年前发布iPhone6S，现在还值得购买吗？</a>
                </div>
                <div class="topic-list-item">
                    <a href="echo_article.php?id=5" class="title">台湾艺人高以翔在宁波录制节目时不幸突逝</a>
                </div>
                <div class="topic-list-item">
                    <a href="echo_article.php?id=9" class="title">从5499到4699，iPhone 11香不香</a>
                </div>
                <div class="topic-list-item">
                    <a href="echo_article.php?id=12" class="title">苹果AirPods Pro和AirPod</a>
                </div>
                <div class="topic-list-item">
                    <a href="echo_article.php?id=13" class="title">22部漫威电影大合集和观影顺序</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <p>Copyright 2019 <a href="#">www.hebaodan.com.cn</a> All Rights Reserved</p>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
EOF;

