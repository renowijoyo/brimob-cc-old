<div id="header">
    <div class="ntmc-bg rad5" id="title">
        <h3>
            <?=$headerTitle?>
        </h3>
    </div>
</div>
<div class="container" style="margin-top: 80px">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <th>
                    No
                </th>
                <th>
                    Lokasi
                </th>
                <th>
                    Status
                </th>
                <th>
                    Last Event
                </th>
            </tr>
            <?php $no=1; for ($i=0; $i <count($cctvWarning) ; $i++) { ?>
            <tr>
                <td>
                    <?php echo $no; ?>
                </td>
                <td>
                    <?php echo $cctvWarning[$i]['channel_name']; ?>
                </td>
                <td>
                    <?php if ($cctvWarning[$i]['map_status'] == 'calm') { 
                    	echo '<img width="52px" height="auto" src="http://202.67.14.247/smartlantas/assets/icon/cctv_calm.png">';
                    } else if ($cctvWarning[$i]['map_status'] == 'warn') {
                    	echo '<img width="52px" height="auto" src="http://202.67.14.247/smartlantas/assets/icon/cctv_warn.png">';
                    } else if ($cctvWarning[$i]['map_status'] == 'problem') {
                    	echo '<img width="52px" height="auto" src="http://202.67.14.247/smartlantas/assets/icon/cctv_alert.png">';
                    } echo "<br>".$cctvWarning[$i]['map_status']; ?>
                </td>
                <td>
                	<iframe style="border: 0" scrolling="no"  src="http://118.91.132.133/Recording/Camlytics%20Media/dir.php?<?php echo $cctvWarning[$i]['channel_id']; ?>/6"></iframe>
                    <iframe style="border: 0" scrolling="no" width="250" height="150" src="<?php echo $cctvWarning[$i]['video_url']; ?>&autoplay=false"></iframe>
                </td>
            </tr>
            <?php $no++;} ?>
        </table>
    </div>
</div>
<!-- Navigation -->
<div id="navigation">
    <div class="right-top">
        <a class="btn btn-primary btn-lg btn-nav" data-placement="bottom" data-toggle="tooltip" href="<?php echo base_url(); ?>maps" id="btn-clear" title="Kembali ke Peta">
            <i class="fa fa-map">
            </i>
        </a>
    </div>
    <div class="clearfix">
    </div>
</div>
<!-- end -->
<!-- Logout -->
<div id="logout">
    <div>
        <a class="logout button ntmc-bg rad5" data-placement="left" data-toggle="tooltip" href="<?=base_url()?>logout" title="Keluar" type="button">
            <i aria-hidden="true" class="fa fa-sign-out">
            </i>
        </a>
    </div>
</div>
<!-- end -->