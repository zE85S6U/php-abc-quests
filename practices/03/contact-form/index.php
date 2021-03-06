<?php
session_start();

// ワンタイムトークンを発行
if(!isset($_SESSION['user'])) {
  $token = sha1(uniqid(mt_rand(), true));
  $_SESSION['user'] = [
    'token' => $token
  ];
}


isset($_REQUEST['name']) ? $name = $_REQUEST['name'] : '';  
isset($_REQUEST['mail']) ? $mail = $_REQUEST['mail'] : '';  
isset($_REQUEST['tel'])  ? $tel  = $_REQUEST['tel']  : '';  
isset($_REQUEST['question'])  ? $question = $_REQUEST['question'] : '';  

// メール送信内容
$settings['admin'] = [
  'to'      => 'hogehoge@gmail.com',
  'subject' => 'お問い合わせがありました',
  'body'    => '以下のお客様からお問い合わせがありました。\n\n
                お名前：山田 太郎\n
                メールアドレス：user-inputted@example.com\n
                お電話番号：090-1234-5678\n
                ご質問内容：
                こんにちは。
                さようなら。'
];

$settings['user'] = [
  'to'      => 'user-inputted@example.com',
  'subject' => 'お問い合わせがありました',
  'body'    => '以下の内容でお問い合わせを受け付けました。\n
                担当者より折り返しご連絡を差し上げますので、今しばらくお待ちください。\n
                お名前：山田 太郎\n
                メールアドレス：user-inputted@example.com\n
                お電話番号：090-1234-5678\n
                ご質問内容：
                こんにちは。
                さようなら。'
];

// 入力チェック
function is_mail($address) {
  if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9?-])+([a-zA-Z0-9\._-]+)+$/", $address)) {
    return TRUE;
  } else {
    return FALSE;
  }
}
// XSS対策
function h($input) {
  return htmlspecialchars($input);
}

if ($name && $mail && $question) {

  $name = h($name);
  $mail = h($mail);
  $tel  = h($tel);
  $question = h($question);

  // メールアドレスチェック
  $is_checkd = is_mail($mail);  

  if ($_SESSION['user']['token'] === $_REQUEST['token']){
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($settings['admin']['to'], $settings['admin']['subject'], $settings['admin']['body'], 'From: <no-reply@example.com>');
    mb_send_mail($settings['user']['to'], $settings['user']['subject'], $settings['user']['body'], 'From: <no-reply@example.com>');
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles.css">
  <title>お問い合わせフォーム</title>
</head>
<body>  
  <main>
    <article>
      <h1>お問い合わせフォーム</h1>

      <?php if (isset(($is_checkd))) { ?>
          <p class="checked_ok">メールの送信が完了しました。</p>
      <?php } else { ?>
          <p class="checked_ng">不正なメールアドレスです。</p>
      <?php } ?>

      <form action="index.php" method="post">
        <p>
          <label>
            <span class="required">お名前 : </span>
            <input type="text"  name="name"  placeholder="例）山田太郎" required>
          </label>
        </p>
          <label>
            <span class="required">メールアドレス : </span>
            <input type="email" name="mail"  placeholder="例）email@example.com" required>
          </label>
        </p>
        </p>
          <label>
            <span>お電話番号 : </span>
            <input type="tel"  name="tel"  placeholder="例）090-1234-5678">
          </label>
        </p>
        </p>
          <label>
            <span class="required">ご質問内容 : </span>
            <textarea name="question" placeholder="ご自由にお書き下さい" required></textarea>
          </label>
        </p>
        <input type="hidden" name="token" value="<?php $_SESSION['user']['token']; ?>">
        <button type="submit">送信</button>
        <button type="reset">リセット</button>
      </form>
    </article>
  </main>
</body>
</html>