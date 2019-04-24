<?php
  $words = array('Wold', 'PHP', 'Web Application');
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
  <?php foreach ($words as $word) { ?>
    <p>Hello, <?php echo $word; ?></p>
  <?php } ?>
</body>
</html>