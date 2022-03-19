//Fn Toggle Stnk//
$(".modal-dialog").draggable({
    handle: ".modal-header"
});

function toggleCCTVReport() {
    $('#contentReportCCTV').html('');
     response = '<a target="_blank" href ="http://118.91.132.133/report/cipinang.png" class="list-group-item list-group-item-action">Cipinang</a>\
<a target="_blank" href ="http://118.91.132.133/report/kalibata.png" class="list-group-item list-group-item-action">Kalibata</a>\
<a target="_blank" href ="http://118.91.132.133/report/dukuhatas.png" class="list-group-item list-group-item-action">Dukuh Atas</a>\
<a target="_blank" href ="http://118.91.132.133/report/halim.png" class="list-group-item list-group-item-action">Halim</a>\
<a target="_blank" href ="http://118.91.132.133/report/armabar.png" class="list-group-item list-group-item-action">Armabar</a>\
<a target="_blank" href ="http://118.91.132.133/report/semanggibawah.png" class="list-group-item list-group-item-action">Semanggi Bawah</a>\
<a target="_blank" href ="http://118.91.132.133/report/mabes.png" class="list-group-item list-group-item-action">Mabes</a>\
<a target="_blank" href ="http://118.91.132.133/report/istiqlal.png" class="list-group-item list-group-item-action">Istiqlal</a>\
<a target="_blank" href ="http://118.91.132.133/report/santa.png" class="list-group-item list-group-item-action">Santa</a>';
$('#contentReportCCTV').append(response);
    // $.ajax({
    //     type: "GET",
    //     url: "http://smart.1500669.com/maps/checkwarning",
    //     dataType: "json",
    //     success: function(res) {
    //         var obj = JSON.parse(JSON.stringify(res));
    //         for (var i = 0; i < obj.length; i++) {
    //             str = obj[i].channel_name.replace(/\s/g, '');
    //             lower = str.toLowerCase();
    //             response = '  <a target="_blank" href ="http://118.91.132.133/report/'+lower+'.png" class="list-group-item list-group-item-action">'+obj[i].channel_name+'</a>';
    //             $('#contentReportCCTV').append(response);
    //         }            
    //     },
    //     error: function(errorThrown) {
    //         console.log(errorThrown);
    //     }
    // });
    $("#listReportCCTV").fadeToggle(1000);
}
//end//
//Fn Toggle Traffic Layer Maps
function toggleTraficLayer() {
    if (trafficLayer.getMap() == null) {
        trafficLayer.setMap(map);
    } else {
        trafficLayer.setMap(null);
    }
}
//end//
//Fn To LatLng Maps//
function toLatLng(lat, lng) {
    return new google.maps.LatLng(lat, lng);
}
//end//
//Fn To Marker Icon//
function toIcon(icon) {
    return new google.maps.MarkerImage(icon, null, null, null, new google.maps.Size(31, 40));
}
//end//
//Fn Clear Marker//
function clearMarkers(identifier) {
    // if (!checkEmptyMarker(identifier)) {
    for (var i = 0; i < markers['' + identifier + ''].length; i++) {
        markers['' + identifier + ''][i].setMap(null);
    }
    markers['' + identifier + ''] = [];
    // }
}
//
//Fn Clear Maps//
function clearMaps() {
    location.reload();
}
//end//
//Fn ZoomInOut Maps//
function zoomIn() {
    map.setZoom(map.getZoom() + 1);
}

function zoomOut() {
    map.setZoom(map.getZoom() - 1);
}
function sateliteView() {
    map.setMapTypeId("satellite");
}
function regularView() {
    const StyleBiasa = new google.maps.StyledMapType([],{ name: "Biasa Uy" });

    map.mapTypes.set("styled_map", StyleBiasa);
    map.setMapTypeId("styled_map");
    $('#darkView').show();
    $('#regularView').hide();
}
function darkView(){
    const StyleDark = new google.maps.StyledMapType(
        [
        {
            "featureType": "all",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 13
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#144b53"
                },
                {
                    "lightness": 14
                },
                {
                    "weight": 1.4
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#08304b"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#0c4152"
                },
                {
                    "lightness": 5
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#0b434f"
                },
                {
                    "lightness": 25
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#0b3d51"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#146474"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#021019"
                }
            ]
        }
    ]
        ,{ name: "DarkMode Uy" });

    map.mapTypes.set("styled_map", StyleDark);
    map.setMapTypeId("styled_map");
    $('#darkView').hide();
    $('#regularView').show();
}
//end//
//Fn Toggle SearchBar//
function toggleSearchBar(type) {
    $("#search-bar").fadeToggle(1000);
    // $("#search-query").focus();
}
//end//
//Fn Toggle Sim//
function toggleSim(type) {
    $("#sim").fadeToggle(1000);
}
//end//
//Fn Toggle Stnk//
function toggleStnk(type) {
    $("#stnk").fadeToggle(1000);
}
function toggleKomparasi(type) {
    $("#data-komparasi").fadeToggle(1000);
}
//end//
//Fn Toggle MenuBar//
function toggleMenuBar() {
    $("#dropdown-menu").fadeToggle(1000);
}
//
//Fn Grow and Shrink//
function grow(x, w) {
    $(x).animate({
        width: w
    }, 500);
}

function shrink(x, w) {
    $(x).animate({
        width: w
    }, 500);
}
//end//
//Fn checkArrayIdentifier
function checkEmptyMarker(identifier) {
    var x = markers['' + identifier + ''];
    if (x === undefined || x.length == 0) {
        return true;
    } else {
        return false;
    }
}
//
//Fn getLaporanMasyarakatId()
function getLaporanMasyarakatId(identifier) {
    switch (identifier) {
        case 'sct_balapan_liar':
            return 10;
            break;
        case 'sct_calo':
            return 14;
            break;
        case 'sct_informasi':
            return 6;
            break;
        case 'sct_kemacetan':
            return 12;
            break;
        case 'sct_kecelakaan':
            return 11;
            break;
        case 'sct_lain_lain':
            return 3;
            break;
        case 'sct_rambu_rambu':
            return 13;
            break;
        case 'sct_pungli':
            return 15;
            break;
        case 'sct_suap':
            return 16;
            break;
        default:
            return 0;
    }
}
//end//
// Fn get icon for laporanMasyarakat//
function getLaporanMasyarakatIcon(identifier) {
    var icon = getCategoryIconData(identifier).icon;
    return '<?base_url()?>assets/icon/' + icon;
}
//end//
//Fn ToggleMenuIdentifier//
// Binding all menu goes here
function toggleMenuIdentifier(identifier) {
    var listCctv = ['sct_cctv_pemda_dki', 'sct_live_drone_cam', 'sct_live_patrol_cam', 'sct_cctv_korlantas','sct_cctv_ai_fr','sct_tactical_cam'];
    var listToggleDiv = ['sct_cek_sim', 'sct_cek_stnk','sct_komparasi_ektp'];
    var listOther = ['sct_lalu_lintas', 'sct_live_traffic_jawa_bali','sct_cctv_report','sct_live_traffic_sumatera','sct_live_traffic_kalimantan','sct_live_traffic_sulawesi','sct_live_traffic_nusa_tenggara','sct_live_traffic_maluku_papua'];
    var listlaporanMasyarakat = ['sct_balapan_liar', 'sct_calo', 'sct_informasi', 'sct_kemacetan', 'sct_kecelakaan', 'sct_lain_lain', 'sct_pungli', 'sct_rambu_rambu', 'sct_suap'];
    var AnggotaPolri = ['sct_anggota_polri'];
    var MobilPjr = ['sct_mobil_pjr'];
    var MotorPjr = ['sct_motor_pjr'];
    //if video
    // if($.inArray(identifier, listCctv)) {
    if (listCctv.includes(identifier)) {
        if (checkEmptyMarker(identifier)) {
            showMarker('mapsData', identifier, getMapsData(identifier));
        } else {
            clearMarkers(identifier);
        }
    }


    //if ToggleDiv
    // if($.inArray(identifier, listToggleDiv)){
    else if (listToggleDiv.includes(identifier)) {
        switch (identifier) {
            case 'sct_cek_sim':
                toggleSim();
                break;
            case 'sct_cek_stnk':
                toggleStnk();
                break;
            case 'sct_komparasi_ektp':
                toggleKomparasi();
                break;
            default:
        }
    }
    //if Other
    else if (listOther.includes(identifier)) {
        switch (identifier) {
            case 'sct_lalu_lintas':
                toggleTraficLayer();
                break;
            case 'sct_live_traffic_jawa_bali':
                 if (checkEmptyMarker('sct_live_traffic_jawa_bali')) {
                    map.setCenter({ lat: -7.2138056, lng: 110.132151 });
                    map.setZoom(7.29);
                    showMarker('mapsData', 'sct_live_traffic_jawa_bali', getMapsData('sct_live_traffic_jawa_bali'));
                } else {
                    clearMarkers('sct_live_traffic_jawa_bali');
                    map.setCenter({lat: -0.9219036, lng: 117.7256732});
                    map.setZoom(5.5);
                }
                break;
            case 'sct_live_traffic_sumatera':
                if (checkEmptyMarker('sct_live_traffic_sumatera')) {
                    map.setCenter({ lat: -0.1592092, lng: 102.677918 });
                    map.setZoom(6.29);
                    showMarker('mapsData', 'sct_live_traffic_sumatera', getMapsData('sct_live_traffic_sumatera'));
                } else {
                    clearMarkers('sct_live_traffic_sumatera');
                    map.setCenter({lat: -0.9219036, lng: 117.7256732});
                    map.setZoom(5.5);
                }
                break;
            case 'sct_live_traffic_kalimantan':
                if (checkEmptyMarker('sct_live_traffic_kalimantan')) {
                    map.setCenter({ lat: 0.057767, lng: 113.3338257 });
                    map.setZoom(6.54);
                    showMarker('mapsData', 'sct_live_traffic_kalimantan', getMapsData('sct_live_traffic_kalimantan'));
                } else {
                    clearMarkers('sct_live_traffic_kalimantan');
                    map.setCenter({lat: -0.9219036, lng: 117.7256732});
                    map.setZoom(5.5);
                }
                break;
            case 'sct_live_traffic_sulawesi':
                if (checkEmptyMarker('sct_live_traffic_sulawesi')) {
                    map.setCenter({ lat: -2.5396654, lng: 121.3665685 });
                    map.setZoom(6.79);
                    showMarker('mapsData', 'sct_live_traffic_sulawesi', getMapsData('sct_live_traffic_sulawesi'));
                } else {
                    clearMarkers('sct_live_traffic_sulawesi');
                    map.setCenter({lat: -0.9219036, lng: 117.7256732});
                    map.setZoom(5.5);
                }
                break;
            case 'sct_live_traffic_nusa_tenggara':
                if (checkEmptyMarker('sct_live_traffic_nusa_tenggara')) {
                    map.setCenter({ lat: -8.5695983, lng: 121.9345061 });
                    map.setZoom(7.04);
                    showMarker('mapsData', 'sct_live_traffic_nusa_tenggara', getMapsData('sct_live_traffic_nusa_tenggara'));
                } else {
                    clearMarkers('sct_live_traffic_nusa_tenggara');
                    map.setCenter({lat: -0.9219036, lng: 117.7256732});
                    map.setZoom(5.5);
                }
                break;
            case 'sct_live_traffic_maluku_papua':
                if (checkEmptyMarker('sct_live_traffic_maluku_papua')) {
                    map.setCenter({ lat: -3.7881808, lng: 131.4310473 });
                    map.setZoom(6.29);
                    showMarker('mapsData', 'sct_live_traffic_maluku_papua', getMapsData('sct_live_traffic_maluku_papua'));
                } else {
                    clearMarkers('sct_live_traffic_maluku_papua');
                    map.setCenter({lat: -0.9219036, lng: 117.7256732});
                    map.setZoom(5.5);
                }
                break;

            case 'sct_cctv_report':
                toggleCCTVReport();
                break;
            default:
        }
    }
    //if LaporanMasyarakat
    else if (listlaporanMasyarakat.includes(identifier)) {
        if (checkEmptyMarker(identifier)) {
            var laporan = getLaporanMasyarakatData(getLaporanMasyarakatId(identifier));
            showMarker('laporanMasyarakat', identifier, laporan);
        } else {
            clearMarkers(identifier);
        }
    }
    // if List Korlantas
    else if (AnggotaPolri.includes(identifier)) {
        if (checkEmptyMarker(identifier)) {
            var laporan = getAnggota();
            showMarker('anggota', identifier, laporan);
        } else {
            clearMarkers(identifier);
        }
    }
    else if (MobilPjr.includes(identifier)) {
        if (checkEmptyMarker(identifier)) {
            var laporan = getMobilPjr();
            showMarker('MobilPjr', identifier, laporan);
        } else {
            clearMarkers(identifier);
        }
    }
    else if (MotorPjr.includes(identifier)) {
        if (checkEmptyMarker(identifier)) {
            var laporan = getMotorPjr();
            showMarker('MotorPjr', identifier, laporan);
        } else {
            clearMarkers(identifier);
        }
    }
}
//end//
//Fn Show Marker//
function showMarker(type, identifier, data) {
    switch (type) {
        case 'cctv':
            for (var i = 0; i < data.length; i++) {
                var id = data[i].id;
                var urlType = data[i].url_type;
                var lat = data[i].lat;
                var lng = data[i].lng;
                var name = data[i].cctv_name;
                var url = data[i].url;
                var icon = data[i].icon;
                if (icon != '') {
                    icon = toIcon('<?=base_url()?>assets/icon/' + data[i].icon);
                } else {
                    icon = undefined;
                }
                markers['' + identifier + ''].splice(i, 0, new google.maps.Marker({
                    map: map,
                    position: toLatLng(data[i].lat, data[i].lng),
                    title: data[i].cctv_name,
                    animation: google.maps.Animation.DROP,
                    icon: icon
                }));
                markers['' + identifier + ''][i].set("urltype", urlType);
                markers['' + identifier + ''][i].set("linkcctv", url);
                markers['' + identifier + ''][i].set("titlecctv", name);
                markers['' + identifier + ''][i].addListener('click', function() {
                    infoWindow = new google.maps.InfoWindow({
                        content: '<button type="button" class="btn btn-primary btn-sm btn-block">' + this.titlecctv + '</button><button onclick="liveStreamShow(\'' + this.channel_name + '\')" type="button" class="btn btn-info btn-sm btn-block">Live Streaming</button><table width="300px"><tr><td><iframe style="border: 0" scrolling="no" width="100%" height="250" src="' + this.linkcctv + '"></iframe></td></tr></table>'
                        });
                    infoWindow.open(this.getMap(), this);
                    // $('#triggerModal').click();
                    // showCctv(this.urltype, this.linkcctv, this.titlecctv)
                });
            }
            break;
        case 'laporanMasyarakat':
            var icon = toIcon(getLaporanMasyarakatIcon(identifier));
            for (var i = 0; i < data.length; i++) {
                var kategori = data[i].sub_kategori;
                var pengaduan = data[i].pengaduan;
                var infoWindow;
                markers['' + identifier + ''].splice(i, 0, new google.maps.Marker({
                    map: map,
                    position: toLatLng(data[i].lat, data[i].lng),
                    //title: data[i].sub_kategori,
                    //animation: google.maps.Animation.DROP,
                    //icon: icon
                }));
                markers['' + identifier + ''][i].set("kategori", kategori);
                markers['' + identifier + ''][i].set("pengaduan", pengaduan);
                markers['' + identifier + ''][i].addListener('click', function() {
                    infoWindow = new google.maps.InfoWindow({
                        content: '<b style="color:black">' + this.kategori + '</b><br/><p style="color:black">' + this.pengaduan + '</p>',
                        maxWidth: 280,
                    });
                    infoWindow.open(this.getMap(), this);
                });
                markers['' + identifier + ''][i].addListener('mouseout', function() {
                    infoWindow.close();
                });
            }
            break;
        case 'MobilPjr':
            for (var i = 0; i < data.length; i++) {
              var id = data[i].id;
                var mobil_name = data[i].mobil_name;
                var lat = data[i].lat;
                var lng = data[i].lng;
                var icon = data[i].icon;
                if (icon != '') {
                    icon = toIcon('<?=base_url()?>assets/icon/' + data[i].icon);
                } else {
                    icon = undefined;
                }
                markers['' + identifier + ''].splice(i, 0, new google.maps.Marker({
                    map: map,
                    position: toLatLng(data[i].lat, data[i].lng),
                    title: data[i].mobil_name,
                    animation: google.maps.Animation.DROP,
                    icon: icon
                }));
            }
            break;
        case 'MotorPjr':
            for (var i = 0; i < data.length; i++) {
              var id = data[i].id;
                var motor_name = data[i].motor_name;
                var lat = data[i].lat;
                var lng = data[i].lng;
                var icon = data[i].icon;
                if (icon != '') {
                    icon = toIcon('<?=base_url()?>assets/icon/' + data[i].icon);
                } else {
                    icon = undefined;
                }
                markers['' + identifier + ''].splice(i, 0, new google.maps.Marker({
                    map: map,
                    position: toLatLng(data[i].lat, data[i].lng),
                    title: data[i].motor_name,
                    animation: google.maps.Animation.DROP,
                    icon: icon
                }));
            }
            break;
        case 'anggota':
            for (var i = 0; i < data.length; i++) {
              var id = data[i].id;
                var anggota_name = data[i].anggota_name;
                var lat = data[i].lat;
                var lng = data[i].lng;
                var icon = data[i].icon;
                if (icon != '') {
                    icon = toIcon('<?=base_url()?>assets/icon/' + data[i].icon);
                } else {
                    icon = undefined;
                }
                markers['' + identifier + ''].splice(i, 0, new google.maps.Marker({
                    map: map,
                    position: toLatLng(data[i].lat, data[i].lng),
                    title: data[i].anggota_name,
                    animation: google.maps.Animation.DROP,
                    icon: icon
                }));
            }
            break;
        case 'live_traffic':
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>maps/checkwarning",
                dataType: "json",
                success: function(res) {
                    function getWarningMarker(){
                        clearMarkers('sct_live_traffic');
                    var data = res;
                    for (var i = 0; i < data.length; i++) {
                        var id = data[i].id;
                        var channel_name = data[i].channel_name;
                        var latitude = data[i].latitude;
                        var longitude = data[i].longitude;
                        var origin = data[i].origin;
                        var snapshot_path = data[i].snapshot_path;
                        var type = data[i].type;
                        var map_status = data[i].map_status;
                        var video_url = data[i].video_url;
                        var channel_id = data[i].channel_id;
                        var icon = toIcon('<?=base_url()?>assets/icon/' + data[i].map_icon);
                        markers['' + identifier + ''].splice(i, 0, new google.maps.Marker({
                            map: map,
                            position: toLatLng(data[i].latitude, data[i].longitude),
                            title: data[i].channel_name,
                            animation: google.maps.Animation.DROP,
                            icon: icon
                        }));
                        markers['' + identifier + ''][i].setAnimation(null);
                        markers['' + identifier + ''][i].set("latitude", latitude);
                        markers['' + identifier + ''][i].set("longitude", longitude);
                        markers['' + identifier + ''][i].set("channel_name", channel_name);
                        markers['' + identifier + ''][i].set("photo_url", snapshot_path);
                        markers['' + identifier + ''][i].set("video_url", video_url);
                        markers['' + identifier + ''][i].set("map_status", map_status);
                        markers['' + identifier + ''][i].set("channel_id", channel_id);
                        markers['' + identifier + ''][i].addListener('click', function() {
                            if (this.map_status == 'calm') {
                                infoWindow = new google.maps.InfoWindow({
                                    content: '<button onclick="liveStreamShow(\'' + this.channel_name + '\')" type="button" class="btn btn-primary btn-sm btn-block">' + this.channel_name + '</button><table width="300px"><tr><td><div class="row"><div class="col-md-6"><button onclick="liveStreamShow(\'' + this.channel_name + '\')" type="button" class="btn btn-info btn-sm btn-block">Live Streaming</button></div><div class="col-md-6"><button onclick="streetViewGo(\'' + this.latitude +','+this.longitude+'\')" type="button" class="btn btn-info btn-sm btn-block">Street View</button></div><iframe style="border: 0" scrolling="no" width="100%" height="250" src="' + this.video_url + '"></iframe></td></tr></table>'
                                });
                                infoWindow.open(this.getMap(), this);
                                // showPopUp(this.channel_name,this.channel_id,this.video_url);
                            } else if (this.map_status == 'warn') {
                                infoWindow = new google.maps.InfoWindow({
                                    content: '<button onclick="liveStreamShow(\'' + this.channel_name + '\')" type="button" class="btn btn-danger btn-sm btn-block">' + this.channel_name + '</button><table width="300px"><tr><td>Last 6 Event<iframe width="100%" scrolling="no" style="border:0;overflow:hidden;" src="http://118.91.132.133/Recording/Camlytics%20Media/dir.php?' + this.channel_id + '/6"></iframe></td></tr><tr><td><div class="row"><div class="col-md-6"><button onclick="liveStreamShow(\'' + this.channel_name + '\')" type="button" class="btn btn-info btn-sm btn-block">Live Streaming</button></div><div class="col-md-6"><button onclick="streetViewGo(\'' + this.latitude +','+this.longitude+'\')" type="button" class="btn btn-info btn-sm btn-block">Street View</button></div><iframe style="border: 0" scrolling="no" width="100%" height="250" src="' + this.video_url + '"></iframe></td></tr></table>'
                                });
                                infoWindow.open(this.getMap(), this);
                                // showPopUp(this.channel_name,this.channel_id,this.video_url);
                            } else if (this.map_status == 'problem') {
                                infoWindow = new google.maps.InfoWindow({
                                    content: '<button type="button" data-toggle="modal" data-target="#modalLS" style="background-color:#808080;border:0px" class="btn btn-block">' + this.channel_name + ' Disconnect </button> <table width="300px"><tr><td>Last 6 Event<iframe width="100%" scrolling="no" style="border:0;overflow:hidden;"  src="http://118.91.132.133/Recording/Camlytics%20Media/dir.php?' + this.channel_id + '/6"></iframe></td></tr><tr><td><div class="row"><div class="col-md-6"></div><div class="row"><div class="col-md-6"></div></div>Live Streaming<iframe style="border: 0" scrolling="no" width="100%" height="250" src="' + this.video_url + '"></iframe></td></tr></table>'
                                });
                                infoWindow.open(this.getMap(), this);
                                showPopUp(this.channel_name, this.channel_id, this.video_url);
                            }
                        });
                    }
                    }
                    getWarningMarker();
                    setInterval(function(){
                        getWarningMarker();
                    },180000);
                },
                error: function(errorThrown) {
                    console.log(errorThrown);
                }

            });
            break;
        case 'mapsData':
        console.log(data);
            for (var i = 0; i < data.length; i++) {
                        var id = data[i].id;
                        var channel_name = data[i].channel_name;
                        var latitude = data[i].latitude;
                        var longitude = data[i].longitude;
                        var map_status = data[i].map_status;
                        var video_url = data[i].video_url;
                        var icon = toIcon('<?=base_url()?>assets/icon/' + data[i].map_icon);
                        markers['' + identifier + ''].splice(i, 0, new google.maps.Marker({
                            map: map,
                            position: toLatLng(data[i].latitude, data[i].longitude),
                            title: data[i].channel_name,
                            animation: google.maps.Animation.DROP,
                            icon: icon
                        }));
                        markers['' + identifier + ''][i].setAnimation(null);
                        markers['' + identifier + ''][i].set("latitude", latitude);
                        markers['' + identifier + ''][i].set("longitude", longitude);
                        markers['' + identifier + ''][i].set("channel_name", channel_name);
                        markers['' + identifier + ''][i].set("video_url", video_url);
                        markers['' + identifier + ''][i].set("map_status", map_status);
                        markers['' + identifier + ''][i].addListener('click', function() {
                                infoWindow = new google.maps.InfoWindow({
                                    content: '<button onclick="liveStreamShow(\'' + this.channel_name + '\')" type="button" class="btn btn-primary btn-sm btn-block">' + this.channel_name + '</button><table width="300px"><tr><td><div class="row"><div class="col-md-6"><button onclick="liveStreamShow(\'' + this.channel_name + '\')" type="button" class="btn btn-info btn-sm btn-block">Live Streaming</button></div><div class="col-md-6"><button onclick="streetViewGo(\'' + this.latitude +','+this.longitude+'\')" type="button" class="btn btn-info btn-sm btn-block">Street View</button></div><iframe style="border: 0" scrolling="no" width="100%" height="250" src="' + this.video_url + '"></iframe></td></tr></table>'
                                });
                                infoWindow.open(this.getMap(), this);
                          
                        });
                    }
            break;
        default:
            console.log('no action');
    }
}
//end//
//Show CCTV on Modals//
function showCctv(urlType, url, title) {
    if (urlType == 'html') {
        html = '<p class="bg-info">Jika tidak tampil kemungkinan CCTV Offline.</p><iframe src="' + url + '" style="width:100%;min-height:50vh;border:0px"></iframe>';
    }
    if (urlType == 'youtube') {
        html = '\
      <p class="bg-info">Jika tidak tampil kemungkinan CCTV Offline.</p>\
      <iframe width="100%" height="400px" src="' + url + '"></iframe>\
    ';
    }
    $('#cctvOut').html(html);
    $('.modal-title').html(title);
}
$('#myModal').on('hidden.bs.modal', function() {
    $('#cctvOut').html("<p>empty.</p>");
});
//
//Modal on hide//
$('#myModal').on('hidden.bs.modal', function() {
    $('#cctvOut').html("<p>empty.</p>");
});
//
"use strict";
function liveStreamShow(channel_name){
    str = channel_name.replace(/\s/g, '');
    lower = str.toLowerCase();
    window.open("<?php echo base_url(); ?>cctv/live/"+lower, str,'resizable,height=560,width=470');
    // window.open("http://118.91.132.131/stream/"+lower+"/livestream2.html?"+channel_name, str,'resizable,height=560,width=470');
}
function streetViewGo(coordinate) {
  LatLng = coordinate.split(',');
  lat = parseFloat(LatLng[0]);
  long = parseFloat(LatLng[1]);
  document.getElementById("pano").style.display = "block";
  var tengahPano = {lat: lat, lng: long};
  var map = new google.maps.Map(document.getElementById('map'), {
    center: tengahPano,
    zoom: 16,
    styles:
    [
        {
            "featureType": "all",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 13
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#144b53"
                },
                {
                    "lightness": 14
                },
                {
                    "weight": 1.4
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#08304b"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#0c4152"
                },
                {
                    "lightness": 5
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#0b434f"
                },
                {
                    "lightness": 25
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#0b3d51"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#146474"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#021019"
                }
            ]
        }
    ]
  });
  var panorama = new google.maps.StreetViewPanorama(
      document.getElementById('pano'), {
        position: tengahPano,
        pov: {
          heading: 34,
          pitch: 10
        }
      });
  map.setStreetView(panorama);
}

//SearchSIM//
function searchSim() {
            $('#load').html('<img src="http://lindungihakpilihmu.kpu.go.id/assets/img/ajax-loader.gif"/>');
            var nik = $('#nik').val();
                $.ajax({
                    type: "POST",
                    url: "http://202.46.1.219/api/index.php/dpt/dpthp",
                    data: {
                        nik: nik,
                    },
                    dataType: "json",
                    success: function(res) {
                        var obj = JSON.parse(JSON.stringify(res));
                        if (obj.message == 'success') {
                            var pemilih = JSON.parse(JSON.stringify(obj.data));
                            $('#load').html('');
                            $('#gagal').html('');
                            $('#namaktp').html(pemilih.nama);
                            $('#namaKabKota').html(pemilih.namaKabKota);
                            $('#namaKecamatan').html(pemilih.namaKecamatan);
                            $('#namaKelurahan').html(pemilih.namaKelurahan);
                            $('#namaPropinsi').html(pemilih.namaPropinsi);
                            $('#nikdata').html(pemilih.nik);
                        }
                    },
                    error: function(errorThrown) {
                        $("#gagal").html("<div class='alert alert-danger alert-dismissible'>\
                                        <h4><i class='icon fa fa-ban'></i> Alert!</h4>\
                                        ANDA BELUM TERDAFTAR ATAU KOMBINASI DAN NIK SALAH.\
                                      </div>");
                        $('#load').html('');
                        console.log(errorThrown);
                    }
                });
}
//
//SearchSTNK//
function searchStnk() {
    $('#form-stnk').html('<p class="bg-info">Mohon maaf saat ini masih dalam perbaikan.</p>');
}
function getMapsData(identifier){
 return getAjax('<?=base_url()?>maps/datamaps?category='+identifier); 
}
//