<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/images/favicon/favicon.png" type="image/x-icon">
</head>
<body>
<?php

//reCAPTCHA v3の処理
if(isset($_POST['recaptchaResponse']) && !empty($_POST['recaptchaResponse'])){
    $secret = 'NkxleERfd1VBQUFBQUFHVkV1V1VrQ1ZVRTE4RWktM3piUFZBMTNudg==';
    $decret = base64_decode($secret);
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$decret.'&response='.$_POST['recaptchaResponse']);
    $reCAPTCHA = json_decode($verifyResponse);
        if (!$reCAPTCHA->success){
        echo "送信エラーになりました。ブラウザの戻るボタンを押して、再度ご送信お願いします。";
        exit;
    }
}else{
    echo "送信エラーになりました。ブラウザの戻るボタンを押して、再度ご送信お願いします。";
    exit;
}
 
// パラメータ取得
$request_param = $_POST;

// お問い合わせ日時
$request_datetime = date("Y年m月d日 H時i分s秒");

//自動返信メール
$mailto = $request_param['mail'];
$to = 'lightcube.c@gmail.com'; //ここを入力
$mailfrom = "From:no-reply@lightcube.cf"; //ここを入力
$subject = "お問い合わせ有難うございます。";

$content = "";
$content .= $request_param['name']. "様\r\n";
$content .= "お問い合わせ有難うございます。\r\n";
$content .= "お問い合わせ内容は下記通りでございます。\r\n";
$content .= "=================================\r\n";
$content .= "お名前	      " . htmlspecialchars($request_param['name'])."\r\n";
$content .= "メールアドレス   " . htmlspecialchars($request_param['mail'])."\r\n";
$content .= "内容   " . htmlspecialchars($request_param['message'])."\r\n";
$content .= "お問い合わせ日時   " . $request_datetime."\r\n";
$content .= "=================================\r\n";

//管理者確認用メール
$subject2 = "お問い合わせがありました。";
$content2 = "";
$content2 .= "お問い合わせがありました。\r\n";
$content2 .= "お問い合わせ内容は下記通りです。\r\n";
$content2 .= "=================================\r\n";
$content2 .= "お名前	      " . htmlspecialchars($request_param['name'])."\r\n";
$content2 .= "メールアドレス   " . htmlspecialchars($request_param['mail'])."\r\n";
$content2 .= "件名   " . htmlspecialchars($request_param['title'])."\r\n";
$content2 .= "内容   " . htmlspecialchars($request_param['message'])."\r\n";
$content2 .= "お問い合わせ日時   " . $request_datetime."\r\n";
$content2 .= "================================="."\r\n";

mb_language("ja");
mb_internal_encoding("UTF-8");
//mail 送信
if($request_param['token'] === '7942368'){
if(mb_send_mail($to, $subject2, $content2, $mailfrom)){
    mb_send_mail($mailto,$subject,$content,$mailfrom);
    ?>
    <script>
        window.location = '/contact/thanks.html';
    </script>
    <?php
} else {
    header('Content-Type: text/html; charset=UTF-8');
  echo "メールの送信に失敗しました";
};
} else {
echo "メールの送信に失敗しました（トークンエラー）";
}

?>
</body>
</html>