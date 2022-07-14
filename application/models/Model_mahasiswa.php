<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_mahasiswa extends CI_Model
{
  public function ambil_mahasiswa()
  {
    $this->db->from('user')->where('id_user', $this->session->userdata('id_user'));
    return $this->db->get()->row();
  }
}
