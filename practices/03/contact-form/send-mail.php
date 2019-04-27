<?php
// XSS対策
function h($input) {
  return htmlspecialchars($input);
}

// メールアドレスチェック
function is_mail($address) {
  if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9?-])+([a-zA-Z0-9\._-]+)+$/", $address)) {
    return true;
  } else {
    return false;
  }
}
if (is_mail($_REQUEST['mail'])) {
  echo 'メールを送信しました';
}else {
  echo '不正なメールアドレスです';
}

?>