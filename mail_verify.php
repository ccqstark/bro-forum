<?php
session_start();
//获取验证码并判断
$post2 = $_POST;
$vercode = $_SESSION['vercode'];

//判断验证码
if($vercode == $post2["verify_code"]) {
    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
          window.alert("注册成功！");
          </script>
EOF;
     //跳转到主页
     echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/main.php"</script>';

}

else{

    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("验证码错误！请重新输入！");
          </script>
EOF;
    echo '<script language=javascript>window.location.href="http://180.76.98.154/winter_camp/mail_verify.html"</script>';

}

unset($_SESSION['vercode']);

?>
