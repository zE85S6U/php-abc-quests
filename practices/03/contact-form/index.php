<link rel="stylesheet" href="styles.css">
<h1>お問い合わせフォーム</h1>

<form action="send-mail.php" method="post">
  <table>
    <tr>
      <td>
        <p class="required">お名前</p>
      </td>
      <td>
        <input type="text"  name="name"  placeholder="例）山田太郎" required>
      </td>
    </tr>
    <tr>
      <td>
        <p class="required">メールアドレス</p>
      </td>
      <td>
        <input type="email" name="mail"  placeholder="例）email@example.com" required>
      </td>
    </tr>
    <tr>
      <td>
        <p>お電話番号</p>
      </td>
      <td>
        <input type="tel"  name="tel"  placeholder="例）090-1234-5678">
      </td>
    </tr>
    <tr>
      <td>
        <p class="required">ご質問内容</p>
      </td>
      <td>
        <textarea name="question" placeholder="ご自由にお書き下さい" cols="30" rows="10" required></textarea>
      </td>
    </tr>
  </table>
  <button type="submit">送信</button>
  <button type="reset">リセット</button>
</form>