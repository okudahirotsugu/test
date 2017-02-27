<?php
  // ここにDBに登録する処理を記述する
  // $nickname = htmlspecialchars($_POST['nickname']);
  // $comment = htmlspecialchars($_POST['comment']);
  

  // １．データベースに接続する
  $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  // ２．SQL文を実行する
  if (!empty($_POST)) {
    $nickname = htmlspecialchars($_POST['nickname']);
    $comment = htmlspecialchars($_POST['comment']);
    $sql = 'INSERT INTO `posts`(`nickname`, `comment`, `created`) VALUES ("'.$nickname.'","'.$comment.'",NOW())';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
  }
  
 

  // ３．データベースを切断する
  $dbh = null;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname"></p>
      <p><input type="text" name="comment" placeholder="comment"></p>
      <p><input  value="つぶやく" type="submit" ></p>
    </form>
    

    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->
<?php
// １．データベースに接続する
$dsn = 'mysql:dbname=oneline_bbs;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

// ２．SQL文を実行する
$sql = 'SELECT * FROM `posts` ORDER BY `id` DESC';
// SQLを実行
$stmt = $dbh->prepare($sql);
$stmt->execute();

while (1) {
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($rec == false) {
    break;
  }
  echo $rec['nickname'] . '<br>';
  echo $rec['comment'] . '<br>';
 echo mb_substr($rec['created'],0, 10 ). '<br>';
  echo '<hr>';
}

// ３．データベースを切断する
$dbh = null;
?>
</body>
</html>