<?php
session_start();

$vercode2 = $_SESSION['vercode2'];
$ans = (int)$_POST['vercode2'];
$vercode2 = (int)$vercode2;

//判断验证码是否正确
if($ans  == $vercode2){
    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("验证成功！");//弹窗提示
        </script>
EOF;
    echo '<script language=javascript>window.location.href="http://localhost/winter_camp/update_password.html"</script>';

}

else{

    echo <<<EOF
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
        <script language=Javascript>
            window.alert("验证失败！");//弹窗提示
        </script>
EOF;

    echo '<script language=javascript>window.location.href="http://localhost/winter_camp/verify_for_newcode.html"</script>';

}

?>
