<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('templates/head', array('title'=>'Live Stream Smart Traffic Command Centre'))?>
    <?php require 'maps/main.css';?>
  </head>
  <body>
  	<?php $chanelNameUrl = str_replace(' ', '', strtolower($stream[0]['channel_name'])); ?>
    <div class="panel panel-default">
  	<div class="panel-body">
  	<h3 id="streamname">Live Stream <?php echo $stream[0]['channel_name'] ?></h3>
  	</div></div>
  <iframe style="width:100%; height:80%;border: 0;" allowfullscreen src="<?php echo $stream[0]['video_url']; ?>"></iframe>
    <?php require 'templates/foot.php';?>

    
    <script type="text/javascript">
      <?php require 'maps/init.js';?>
      <?php require 'maps/fn.js';?>
      <?php require 'maps/fn.ajax.js';?>
    </script>
  </body>
</html>
