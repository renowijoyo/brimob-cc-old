<?php
/**
 * Class Login Model
 */
class Login_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  function getHashedPassword($username){
    $sql = "SELECT password FROM user WHERE username = '$username' AND level_user = 'smartlantas' LIMIT 1";
    $q = $this->db->query($sql);
    return $q->first_row();
  }

  function getDetail($username){
    $sql = "
      SELECT iduser, username, level_user, satwil_id,
      satwil, polda.idpolda as polda_id, polda
      FROM user
  		LEFT JOIN satwil ON satwil.idsatwil = user.satwil_id
  		LEFT JOIN polda ON polda.idpolda = user.polda_id
  		WHERE username = '$username' AND level_user = 'smartlantas'
      LIMIT 1";
  	$q = $this->db->query($sql);
  	return $q->first_row();
  }

}


 ?>
