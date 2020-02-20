<?php
class Login_model extends CI_Model{

	function auth($email,$password){
		$query=$this->db->query("SELECT * FROM tbl_reselleradmin WHERE (password=MD5('$password') AND aktif_state='1') AND (email='$email' OR username='$email' OR no_telp='$email')");
		return $query;
	}

	function loginreseller($username,$password){
		$query=$this->db->query("SELECT * FROM tbl_reselleradmin WHERE (password='$password' AND aktif_state='1') AND (email='$username' OR username='$username' OR no_telp='$username')");
		return $query;
	}
}
?>