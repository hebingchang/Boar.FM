
<!DOCTYPE html>
<?php  
//header("Content-type:text/html;charset=utf-8"); 
include 'lyric.php';
include 'api.php'
?>  
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Boar.FM</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="./css/kk_lrc.css" />
	<script type="text/javascript" src="./js/kk_lrc.js"></script>
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


	
  </head>
	<?php
	$id=$_GET['id'];
	if (empty($id)) {
		echo "<script language='javascript' type='text/javascript'>";  
		echo "window.location.href='songs.php?now=" . $id . "'";  
		echo "</script>";  
		exit;
	}
	$url='http://music.163.com/api/song/detail/?id='.$id.'&ids=['.$id.']';
	$lyurl='http://music.163.com/api/song/lyric/?id='.$id.'&lv=-1&kv=-1&tv=-1';
	$con=curl($url,''); 
	$lycon=curl($lyurl,'');
	$json=json_decode($con,true);
	$lyjson=json_decode($lycon,true);
	$name=$json['songs']['0']['name'];
	$audio=$json['songs']['0']['mp3Url'];
	$album=$json['songs']['0']['album']["name"];
	$artist=$json['songs']['0']['artists']['0']["name"];
	$lyric=$lyjson['lrc']['lyric'];
	$pic=$json['songs']['0']['album']["blurPicUrl"];
	//echo ($listjson['result']['tracks']['0']['id']);

	//download_remote_file($pic, realpath("./pictures") . '/' . basename($pic));	
	//				$image = new lib_image_imagick();
					 
	//				$image->open('./pictures/' . basename($pic));
	//				$image->resize_to(100, 100, 'scale_fill');
	//				$image->gaussian_blur(20, 20);
	//				$image->save_to('./pictures/show' . basename($pic));

	//preg_match('|"mp3Url":"(.*)"|U',$con,$mp3);
	//audio=$mp3[1];
	//header('Content-Type:application/force-download');
	//header("Location:".$audio);
?>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Boar.FM</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Music</a></li>
                  <!--<li><a href="#">Features</a></li>
                  <li><a href="#">Contact</a></li>-->
                </ul>
              </nav>
            </div>
          </div>
  <div id="container" style="z-index:2">
	<!--<label class="to-back-label" for="to-back"><i class="fa fa-bars fa-lg"></i></label>
	<input type="checkbox" id="to-back"><!-- playlist toggle -->
	<canvas id="progress" width="320" height="320"></canvas><!-- progress bar -->
	<div id="player">
		<audio id="audio" controls autoplay="autoplay">
			<source src=<?php echo('"' . $audio . '"'); ?> type="audio/mpeg" codecs="mp3"></source>		
		</audio>
		<img src=<?php echo('"' . $pic . '"'); ?>><!-- album cover -->

		<div class="cover">
			<div class="controls">
				<button id="play-pause" title="Pause" onclick="togglePlayPause()"><i class="fa fa-pause fa-3x"></i></button>
				<button id="forward" title="Forward" onclick=<?php echo ("window.location.href='songs.php?now=" . $id . "'"); ?>><i class="fa fa-forward fa-2x"></i></button>
			</div><!-- #controls -->
			<div class="info">
				<p class="song"><a href=<?php echo '"' . $audio . '" download="' . $artist . ' - ' . $name . '.mp3"'; ?>><?php echo($name); ?></a></p>
				<p class="author"><a href="#"><?php echo($artist); ?></a></p>
			</div><!-- #info -->
		</div><!-- #cover -->
	</div><!-- #player -->
</div><!-- #container -->
<?php 
	for ($i=0;$i<=19;$i++) {
		echo('<br />'); 
	}
?>
<div class="kk_lrc_box" style="z-index:1"><ul id="audio_lrc" class="kk_lrc"><li></li><li></li><li></li></ul></div>  <script>var lyric = load_kk_lrc();<?php echo(lyrictrans($lyric));?>
lyric.init();</script>
<script>
	var canvas = document.getElementById('audio');
	audio.addEventListener('ended', function () {
    canvas.pause();
	window.location.href='songs.php?now=' + <?php echo ($id); ?>;
	}, false);
</script>
        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="js/index.js"></script>
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
