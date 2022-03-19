<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('templates/head', array('title'=>'Smart Command Center'))?>
    <?php require 'maps/main.css';?>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  </head>
  <body>

    <?php require 'maps/content.php';?>
    <?php require 'templates/foot.php';?>
      
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBijiL5N2m_Um-uV-gkF5y5D_GApt9W7Vs&libraries=places&callback=initMap" async defer></script>

    <script type="text/javascript">
      <?php require 'maps/init.js';?>
      <?php require 'maps/fn.js';?>
      <?php require 'maps/fn.ajax.js';?>
    </script>
  </body>
</html>
