
<!-- Header -->
<div id="header">
  <div id="title" class="ntmc-bg rad5">
    <h3><?=$headerTitle?></h3>
  </div>
</div>
<!-- end -->

<!-- MAP -->
<div id="map"></div>
<div id="pano" style="display: none;"></div>

<!-- end -->

<!-- Zoom -->
<div id="zoom-control">
  <div id="darkView" style="display: none;">
    <button type="button" class="zoom button rad5 ntmc-bg" onclick="darkView()">
      <i class="fa fa-toggle-off fa-md" aria-hidden="true"></i>
    </button>
  </div>
  <div id="regularView">
    <button type="button" class="zoom button rad5 ntmc-bg" onclick="regularView()">
      <i class="fa fa-toggle-on fa-md" aria-hidden="true"></i>
    </button>
  </div>
  <div style="margin-top:5px">
    <button type="button" class="zoom button rad5 ntmc-bg" onclick="zoomIn()">
      <i class="fa fa-search-plus fa-lg" aria-hidden="true"></i>
    </button>
  </div>
  <div style="margin-top:5px">
    <button type="button" class="zoom button rad5 ntmc-bg" onclick="zoomOut()">
      <i class="fa fa-search-minus fa-lg"></i>
    </button>
    <button type="button" class="zoom button rad5 ntmc-bg" onclick="sateliteView()">
      <i class="fa fa-map fa-lg"></i>
    </button>
  </div>
</div>
<!-- end -->

<!-- Logout -->
<div id="logout">
  <div>
    <a type="button" href="<?=base_url()?>logout" class="logout button ntmc-bg rad5" data-toggle="tooltip" data-placement="left" title="Keluar">
      <i class="fa fa-sign-out" aria-hidden="true"></i>
    </a>
  </div>
</div>
<!-- end -->

<!-- Navigation -->
<div id="navigation">

  <div class="right-top">
    <a href="#" class="btn btn-danger btn-lg btn-nav" id="btn-clear" data-toggle="tooltip" data-placement="bottom" title="Bersihkan Peta" onclick="clearMaps()"><i class="fa fa-times"></i></a>
    <a href="#" class="btn btn-info btn-lg btn-nav" id="btn-search" onclick="toggleSearchBar('show')"><i class="fa fa-search"></i></a>
    <a href="#" class="btn btn-success btn-lg btn-nav" id="btn-menu" onclick="toggleMenuBar('show')"><i class="fa fa-bars"></i></a>
  </div>

  <div class="clearfix"></div>

  <div id="search-bar" style="float:right">
      <div class="form-group" style="margin-bottom:0px;">
        <input id="search-query" type="text" class="form-control" placeholder="Cari Lokasi.." onfocus="grow(this, 500)" onblur="shrink(this, 200)">
      </div>
  </div>

  <div class="clearfix"></div>

  <div id="dropdown-menu" style="float:right">
    <div class="panel list-group ntmc-bg">
      <?php for($i=0; $i < count($categorys); $i++): ?>
        <?php
          $categoryId = $categorys[$i]['id'];
          $categoryIdentifier = $categorys[$i]['identifier'];
          $categoryName = $categorys[$i]['name'];
          $subCategory = $categorys[$i]['sub_category'];
        ?>
        <li class="list-group-item list-item-head ntmc-bg" data-toggle="collapse" data-target="#<?=$categoryIdentifier?>">
          <b><?=$categoryName?></b>
        </li>
        <div id="<?=$categoryIdentifier?>" class="sublinks <?=($categoryId != 1 ? 'collapse': ''); ?>">
          <?php for ($j=0; $j < count($subCategory); $j++): ?>
            <li class="list-group-item ntmc-bg5">
              <div class="checkbox">
                <label>
                  <input type="checkbox" id="<?=$subCategory[$j]['identifier']?>" onclick="toggleMenuIdentifier('<?=$subCategory[$j]['identifier']?>')">
                  <?=$subCategory[$j]['name']?>
                </label>
              </div>
            </li>
          <?php endfor; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<!-- end -->

<!-- CekBar -->
<div id="cek-bar">
  <!-- Search SIM -->
  <div id="sim" class="rad5 ntmc-bg white" style="display:none">
    <h4><i class="fa fa-id-card-o" aria-hidden="true"></i> Cek Data</h4>
    <style type="text/css">
        #my-divkpu
        {
            width    : 390px;
            height: 427px;
            overflow : hidden;
            position : relative;
        }

        #my-iframekpu
        {
            position : absolute;
            top      : -100px;
            left: -75px;
            right: -75px;
            width    : 540px;
            height   : 525px;
        }

      </style>
      <div id="my-divkpu">
        <iframe id="my-iframekpu" src='https://lindungihakpilihmu.kpu.go.id/' scrolling="no" frameborder="0" width="490px"></iframe>
      </div>
  </div>
  <!-- end -->
  <!-- data Komparasi -->
<div id="cek-bar">
  <!-- Data Komparasi -->
  <div id="data-komparasi" class="rad5 ntmc-bg white" style="display:none">
    <h4><i class="fa fa-id-card-o" aria-hidden="true"></i> Data Komparasi EKTP</h4>
    <style type="text/css">
        #my-divKomparasi
        {
            width    : 390px;
            height: 427px;
            overflow : hidden;
            position : relative;
        }

      </style>
      <div id="my-divKomparasi">
        <img width="auto" height="450px" src="http://scc.1500669.com/assets/icon/datakomparasi.jpeg">
      </div>
  </div>
  <!-- end -->
  <!-- Search STNK -->
  <div id="stnk" class="rad5 ntmc-bg white" style="display:none;width: 310px;">
    <!-- <h4><i class="fa fa-id-card-o" aria-hidden="true"></i> Cari data STNK</h4>
    <div id="form-stnk">
      <div class="form-group">
        <label for="usr">Plat Nomor:</label>
        <input type="text" class="form-control" placeholder="B1234ABC">
      </div>
      <button type="button" class="btn btn-sm btn-info" style="width:100%" onclick="searchStnk()">
        <i class="fa fa-search"></i> Cari
      </button>
    </div> -->
    <style type="text/css">
      #my-div
      {
          width    : 300px;
          height: 500px;
          overflow : hidden;
          position : relative;
      }
       
      #my-iframe
      {
          position : absolute;
          top      : -170px;
          left: -100px;
          right: -100px;
          width    : 490px;
          height   : 700px;
      }
      
    </style>
    <div id="my-div">
      <iframe id="my-iframe" src='http://samsat-pkb2.jakarta.go.id/INFO_KBM' scrolling="no" frameborder="0" width="490px"></iframe>  
    </div>
  </div>
  <!-- end -->
  <!-- Search CCTVREPORT -->
  <div id="listReportCCTV" class="rad5 ntmc-bg white" style="display:none;width: 310px;">
    <h4><i class="fa fa-list-alt" aria-hidden="true"></i> Data Report CCTV</h4>
    <div id="contente">
        <div class="list-group-item list-group-item-action" id="contentReportCCTV">

        </div>
    </div>
  </div>
  <!-- end -->
</div>
<!-- end -->

<!-- Modal for CCTV -->
<button id="triggerModal" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"></button>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="display:inline-block">CCTV</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="min-height: 80vh">
        <div id="cctvOut" style="max-height:300px;"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end -->

<!-- Modal for KTP -->

<div id="ktpModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="display:inline-block">Data dari pencarian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="min-height: 20vh">
        <div id="ktpout" style="max-height:300px;">
          <div id="load"></div>
          <div id="gagal"></div>
          <table class="table">
            <tr>
              <th>NIK</th>
              <td id="nikdata"></td>
            </tr>
            <tr>
              <th>NAMA</th>
              <td id="namaktp"></td>
            </tr>
            <tr>
              <th>Kab / Kota</th>
              <td id="namaKabKota"></td>
            </tr>
            <tr>
              <th>Kecamatan</th>
              <td id="namaKecamatan"></td>
            </tr>
            <tr>
              <th>Kelurahan</th>
              <td id="namaKelurahan"></td>
            </tr>
            <tr>
              <th>Propinsi</th>
              <td id="namaPropinsi"></td>
            </tr>
          </table>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end -->
