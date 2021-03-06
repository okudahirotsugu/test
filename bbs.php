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
  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<form method="POST" action="">
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fa fa-linux"></i> Oneline bbs</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <!-- Bootstrapのcontainer -->
  <div class="container">
    <!-- Bootstrapのrow -->
    <div class="row">

      <!-- 画面左側 -->
      <div class="col-md-4 content-margin-top">
    <div class="form-group">
            <div class="input-group">
              <input  type="text" name="nickname" class="form-control" id="validate-text" placeholder="nickname" required>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- comment -->
          <div class="form-group">
            <div class="input-group" data-validate="length" data-length="4">
              <textarea type="text" class="form-control" name="comment" id="validate-length" placeholder="comment" required></textarea>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- つぶやくボタン -->
          <input type="submit" class="btn btn-primary col-xs-12" value="つぶやく">
        </form>
      </div>

      <!-- 画面右側 -->
      <div class="col-md-8 content-margin-top">
        <div class="timeline-centered">
          <article class="timeline-entry">
              <div class="timeline-entry-inner">
                  <div class="timeline-icon bg-success">
                      <i class="entypo-feather"></i>
                      <i class="fa fa-cogs"></i>
                  </div>
                  <div class="timeline-label">
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
  echo '<h2>'.'<a href="">'.$rec['nickname'].'</a>' . '<span>'.' '.mb_substr($rec['created'],0, 10 ).'</span>'.'<br>'.'</h2>';
 echo '<p>'.$rec['comment'].'</p>'. '<br>';
  echo '<hr>';
}

// ３．データベースを切断する
$dbh = null;
?>
                    
                      
                  </div>
              </div>
          </article>

          <article class="timeline-entry begin">
              <div class="timeline-entry-inner">
                  <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
                      <i class="entypo-flight"></i> +
                  </div>
              </div>
          </article>
        </div>
      </div>

    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/form.js"></script>
</body>
</html>





    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->

</body>
</html>