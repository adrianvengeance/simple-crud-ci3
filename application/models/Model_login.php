<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_login extends CI_Model{
	
	function cek_data_pengguna($username,$password)
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$Q = $this->db->get('user');
		if($Q -> num_rows() > 0){
			foreach ($Q -> result_array() as $row){
				$data[]=$row;
			}
		}
		$Q->free_result();
		return $data;
	}
}