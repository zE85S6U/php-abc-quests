<?php
session_start();

$settings = require __DIR__ . '/../../secret-settings.php';
$left = isset($_GET['left']) ? $_GET['left'] : null;
$operator = isset($_GET['operator']) ? $_GET['operator'] : '+';
$right = isset($_GET['right']) ? $_GET['right'] : null;
$result = '計算結果なし';

// ワンタイムトークンを発行
if(!isset($_SESSION['user'])) {
  $token = sha1(uniqid(mt_rand(), true));
  $_SESSION['user'] = [
    'token' => $token
  ];
}

switch (strtolower($_SERVER['REQUEST_METHOD'])) {
  case 'post':
    if (isset($_POST['result'])) {
      $body =
        "簡易電卓プログラムの記念報告メールです。".
        "\n".
        "計算内容:{$_POST['result']}\n".
        "IPアドレス:{$_SERVER['REMOTE_ADDR']}\n"
      ;
      // mb_language('Japanese');
      // mb_internal_encoding('UTF-8');
      // mb_send_mail($settings['email'], '簡易電卓プログラム記念報告', $body, 'From: ' . mb_encode_mimeheader('簡易電卓プログラム') . ' <no-reply@example.com>');
      mail($settings['email'], 'test_mail', $body, 'From: test_program <no-reply@example.com>');
    }
    break;
  
  case 'get':  
  default:
    if (!is_null($left) && !is_null($right)) {
      switch ($operator) {
        case '-':
          $anser = $left - $right;
          break;
        case '*':
          $anser = $left * $right;
          break;
        case '/':
          $anser = $left / $right;
          break;
        case '+':
        default:
          $anser = $left + $right;
          break;
      }
      $result = "{$left} {$operator} {$right} = {$anser}";
    }
    break;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>test</title>
</head>

<body>
<form action="index.php" method="GET">
  <input type="text" name="left" value="<?= $_REQUEST['left']; ?>" required autofocus>
  <select name="operator">
    <option value="+" <?php if ($_REQUEST['operator'] === '+' )  echo 'selected'; ?>>+</option>
    <option value="-" <?php if ($_REQUEST['operator'] === '-' )  echo 'selected'; ?>>-</option>
    <option value="*" <?php if ($_REQUEST['operator'] === '*' )  echo 'selected'; ?>>*</option>
    <option value="/" <?php if ($_REQUEST['operator'] === '/' )  echo 'selected'; ?>>/</option>
  </select>
  <input type="text" name="right" value="<?= $_REQUEST['right']; ?>"  required>
  <input type="hidden" name="token" value="<?= $_SESSION['user']['token']; ?>" >
  <input type="submit" value="計算する">
</form>
<p><?= htmlspecialchars($result); ?></p>

<hr>

<?php if (isset($anser) && $anser % 100 === 0) { ?>
  <p>計算結果が100の倍数になったら記念報告！</p>
  <form action="index.php" method="post">
    <input type="hidden" name="result" value="<?php echo $result; ?>">
    <input type="submit" value="メールで報告する">
  </form>
<?php } ?>

</body>

</html>