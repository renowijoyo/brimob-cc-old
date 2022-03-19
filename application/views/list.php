<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('templates/head', array('title'=>'Smart Traffic Command Centre'))?>
    <?php require 'maps/main.css';?>
  </head>
  <body>

    <?php require 'list_content.php';?>
    <?php require 'templates/foot.php';?>

    
    <script type="text/javascript">
      <?php require 'maps/init.js';?>
      <?php require 'maps/fn.js';?>
      <?php require 'maps/fn.ajax.js';?>
    </script>
  </body>
</html>
