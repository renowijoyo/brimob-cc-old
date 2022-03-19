<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 100%; }
      #triggerModal { display: none; }
    </style>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>

    <!-- Button trigger modal -->
    <button id="triggerModal" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"></button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document" style="width: 90%;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">CCTV</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body" style="min-height: 80vh">
            <div id="cctvOut"></div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- MAP -->
    <div id="map">

    </div><!-- /.map -->

    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Google Map Api JS -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyCRJe0eFR91duh9KRwWY31i0yrYiCFzYvY&callback=initMap" async defer></script>
    <script>
      //Global Variable

      // function hidup(id) {
      //   $.ajax({
      //     async:false,
      //     url: 'http://202.67.14.219/~david/balitower/api_hidup.php?id='+id,
      //     success: function(data, status){
      //       location.reload();
      //     }
      //   });
      // }
      //
      // function mati(id) {
      //   $.ajax({
      //     async:false,
      //     url: 'http://202.67.14.219/~david/balitower/api_mati.php?id='+id,
      //     success: function(data, status){
      //       location.reload();
      //     }
      //   });
      // }

      function getCctv(){
        var res = '';
        $.ajax({
          async:false,
          url: "http://stcc.1500669.com/maps/getcctvpemda",
          success: function(data, status){
            res = data;
          }
        });
        return res;
      }

      //Func Show CCTV
      function showCctv(id, url, title){
        html = '\
        <button type="button" class="btn btn-success" onclick="addToMap('+id+')">Add to Map</button>\
        <br/><br/>\
        <iframe src="'+url+'" style="width:100%;min-height:75vh;border:0px"></iframe>';
        $('#cctvOut').html(html);
        $('.modal-title').html(title);
      }

      function addToMap(id){
        $.ajax({
          async:false,
          url: 'http://stcc.1500669.com/maps/addtocctv?id='+id,
          success: function(){
            location.reload();
          }
        });
      }

      //Func Init Map
      function initMap() {
        datacctv = getCctv();
        var myCenter = new google.maps.LatLng(-6.206518, 106.849418);
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myCenter,
            scrollwheel: true,
            zoom: 12
          });
        for(var i = 0; i <= datacctv.length; i++){
          var idi = datacctv[i].cctv_id;
          var lati = datacctv[i].lat;
          var lngi = datacctv[i].lng;
          var cctvi = datacctv[i].url;
          var titlei = datacctv[i].site_name;
          var myLatLng = new google.maps.LatLng(lati, lngi);

          // Create a marker and set its position.
          var marker = new Array();
          marker[i] = new google.maps.Marker({
            map: map,
            position: myLatLng,
            title: titlei
          });
          marker[i].set("id", idi);
          marker[i].set("linkcctv", cctvi);
          marker[i].set("titlecctv", titlei);
          marker[i].addListener('click', function() {
            $('#triggerModal').click();
            showCctv(this.id, this.linkcctv, this.titlecctv)
          });
        }
      }//initMap

      $('#myModal').on('hidden.bs.modal', function () {
        $('#cctvOut').html("<p>empty.</p>");
      });
    </script>
  </body>
</html>
