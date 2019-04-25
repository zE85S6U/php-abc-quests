<?php
if (isset($_REQUEST['operator'])) {
  $formula = $_REQUEST['left'].$_REQUEST['operator'].$_REQUEST['right'];

  switch ($_REQUEST['operator']) {
    case '-':
      $answer = $_REQUEST['left'] - $_REQUEST['right'];
      $result = $formula.'='. $answer;
      break;
    case '*':
      $answer = $_REQUEST['left'] * $_REQUEST['right'];
      $result = $formula.'='. $answer;
      break;
    case '/':
      $answer = $_REQUEST['left'] / $_REQUEST['right'];
      $result = $formula.'='. $answer;
      break;
    case '+':
    default :
      $answer = $_REQUEST['left'] + $_REQUEST['right'];
      $result = $formula.'='. $answer;
      break;
  }
} else {
  $result = '計算結果なし';
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
<form action="index.php" method="post">
  <input type="text" name="left" value="<?= $_REQUEST['left']; ?>" required autofocus>
  <select name="operator">
    <option value="+" <?php if ($_REQUEST['operator'] === '+' )  echo 'selected'; ?>>+</option>
    <option value="-" <?php if ($_REQUEST['operator'] === '-' )  echo 'selected'; ?>>-</option>
    <option value="*" <?php if ($_REQUEST['operator'] === '*' )  echo 'selected'; ?>>*</option>
    <option value="/" <?php if ($_REQUEST['operator'] === '/' )  echo 'selected'; ?>>/</option>
  </select>
  <input type="text" name="right" value="<?= $_REQUEST['right']; ?>"  required>
  <input type="submit" value="計算する">
</form>

<p><?= $result ?></p>
</body>

</html>