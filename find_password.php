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

$username = $_POST['username'];
$_SESSION['god'] = $username;


$result = mysqli_query($conn,"SELECT * FROM forum_user
WHERE username = '$username'");
$row = array();
while($row = mysqli_fetch_array($result))
{
   $the_email = $row['email'];
}

require_once("PHPMailer.php");
require_once("SMTP.php");
$post = '1367305698@qq.com';
$vercode2 = rand(1000,9999);
$_SESSION['vercode2'] = $vercode2;

function sendMail($to,$title,$content){

//实例化PHPMailer核心类
    $mail = new \PHPMailer\PHPMailer\PHPMailer();

//是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 1;

//使用smtp鉴权方式发送邮件
    $mail->isSMTP();

//smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;

//链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';

//设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';

//设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;

//设置发件人的主机域 可有可无 默认为180.76.98.154 内容任意，建议使用你的域名
    $mail->Hostname = '1367305698.qq.com';

//设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';

//设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '弟弟论坛CEO ccq';

//smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='1367305698';

//smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
    $mail->Password = 'ezysmbtxxuynihdb';

//设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = '1367305698@qq.com';

//邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);

//设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to,'用户弟弟');

//添加该邮件的主题
    $mail->Subject = $title;

//添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;

    $status = $mail->send();

}

$address = $_POST['email_address'];

if($address == $the_email){

    sendMail("$address", '验证码', '宁好，宁弟弟论坛修改密码的邮箱验证码为'.$vercode2.'。可不用妥善保存，可以随意丢弃删除，甚至可以告诉他人。');
    echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/verify_for_newcode.html"</script>';

}
else{
    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("邮箱地址不正确！");//弹窗提示
        </script>
EOF;

}

?>