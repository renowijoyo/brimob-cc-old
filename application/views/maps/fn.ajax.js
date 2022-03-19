// Fn Get Markers //
function getMarkers(){
  return getAjax('<?=base_url()?>maps/markers');
}
//end//

//Fn Get CCTV//
function getCctvs(identifier){
  return getAjax('<?=base_url()?>maps/cctvs?identifier='+identifier);
}
//end//
// Fn Get Warning
function getWarning(){
 return getAjax('<?=base_url()?>maps/checkwarning'); 
}
//Fn Get Cases//
function getCases(){
  return getAjax('<?=base_url()?>maps/cases');
}
//end//

//Fn Get Categorys//
function getCategorys(){
  return getAjax('<?base_url()?>maps/categorys');
}
//end//

//Fn getLaporanMasyarakatData
function getLaporanMasyarakatData(categoryId){
  return getAjax('<?base_url()?>maps/casesfrom?category_id='+categoryId);
};
//end

//Fn getCategoryIconData//
function getCategoryIconData(identifier){
  return getAjax('<?base_url()?>maps/iconcategory?identifier='+identifier);
}
//end//

function getAnggota(){
  return getAjax('<?=base_url()?>maps/getAnggota');
}
function getMobilPjr(){
  return getAjax('<?=base_url()?>maps/getMobilPjr');
}
function getMotorPjr(){
  return getAjax('<?=base_url()?>maps/getMotorPjr');
}

//Fn Get Ajax Data//
function getAjax(url){
  var res;
  $.ajax({
    async: false,
    url: url,
    success: function(data){res = data;}
  });
  return res;
}
//
