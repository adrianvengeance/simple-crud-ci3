<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $sesi_login = $this->session->userdata('loginMasuk');
    $level_pengguna = $this->session->userdata('level_pengguna');
    if ($sesi_login == false || $level_pengguna != 'Mahasiswa') {
      redirect('login');
    }
  }

  public function index()
  {
    $orang = $this->model_mahasiswa->ambil_mahasiswa();
    $data = [
      'judul' => 'Selamat Datang',
      'header' => 'user/layout/header',
      'footer' => 'user/layout/footer',
      'isi' => 'user/isi/welcome',
      'nama'  => $orang->nama_user
    ];
    $this->load->view('admin/layout/layout', $data);
  }

  public function profil()
  {
    $orang = $this->model_mahasiswa->ambil_mahasiswa();
    $data = [
      'judul'   => 'Profil',
      'header'  => 'user/layout/header',
      'footer'  => 'user/layout/footer',
      'isi'     => 'user/isi/profil',
      'mahasiswa'  => $this->model_mahasiswa->ambil_mahasiswa(),
      'nama'  => $orang->nama_user
    ];
    // var_dump(($orang->password));
    $this->load->view('admin/layout/layout', $data);
  }

  public function update_profil()
  {
    // $data = ($this->input->post());
    // $this->_validate_update_profile();
    // $this->model_pendaftaran->update_profile($data);
    // $this->session->set_flashdata('profil', 'Profil berhasi diubah');
    // echo json_encode(array("status" => TRUE));

    $this->_validate_profil();
    $config['upload_path'] = './assets/gambar';
    $config['allowed_types'] = 'jpg|png|jpeg|bmp|pdf';
    $config['encrypt_name'] = true;

    $this->upload->initialize($config);
    if (!empty($_FILES['userfile'])) {
      if ($this->upload->do_upload('userfile')) {
        $gambar = $this->upload->data();
        $config = [
          'image_library' => 'gd2',
          'source_image'  => './assets/gambar' . $gambar['file_name'],
          'create_thumb'  => false,
          'maintain_ratio' => false,
          'max_size'      => 50000,
          'width'         => 200,
          'height'        => 250,
          'new_image'     => '.assets/gambar' . $gambar['file_name']
        ];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $gambarl = array('gambar' => $gambar['file_name']);
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('user', $gambarl);
      }
    }
    $datal = array(
      'username'  => $this->input->post('username'),
      'nama_user' => $this->input->post('nama_user'),
    );
    $this->db->where('id_user', $this->session->userdata('id_user'));
    $this->db->update('user', $datal);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_gambar()
  {
    $data['gambarnya'] = $this->model_mahasiswa->ambil_mahasiswa();
    $this->load->view('user/isi/ajax_gambar', $data);
  }

  private function _validate_profil()
  {
  }

  private function _validate_update_profile()
  {
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    $username = $this->input->post('username');
    $cek_usernamnya = count($this->model_pendaftaran->cek_username($username));

    if ($this->input->post('nama_user') == '') {
      $data['inputerror'][] = 'nama_user';
      $data['error_string'][] = 'Field tidak boleh kosong';
      $data['status'] = FALSE;
    }
    if ($this->input->post('username') == '') {
      $data['inputerror'][] = 'username';
      $data['error_string'][] = 'Field tidak boleh kosong';
      $data['status'] = FALSE;
    }
    if ($cek_usernamnya == 1) {
      $data['inputerror'][] = 'username';
      $data['error_string'][] = 'Username telah digunakan';
      $data['status'] = FALSE;
    }
    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }
  }

  public function update_password()
  {
    $this->_validate_update_password();
    $data = ['password' => md5($this->input->post('password_baru_lagi'))];
    $this->model_pendaftaran->update_profile($data);
    $this->session->set_flashdata('profil', 'Password berhasil diubah');
    echo json_encode(array("status" => TRUE));
  }

  private function _validate_update_password()
  {
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if ($this->input->post('password') == '') {
      $data['inputerror'][] = 'password';
      $data['error_string'][] = 'Field tidak boleh kosong';
      $data['status'] = FALSE;
    }
    if ($this->input->post('password_baru') == '') {
      $data['inputerror'][] = 'password_baru';
      $data['error_string'][] = 'Field tidak boleh kosong';
      $data['status'] = FALSE;
    }
    if ($this->input->post('password_baru_lagi') == '') {
      $data['inputerror'][] = 'password_baru_lagi';
      $data['error_string'][] = 'Field tidak boleh kosong';
      $data['status'] = FALSE;
    }
    if ($this->input->post('password_baru_lagi') != $this->input->post('password_baru')) {
      $data['inputerror'][] = 'password_baru_lagi';
      $data['error_string'][] = 'Verifikasi password tidak sama';
      $data['status'] = FALSE;
    }

    $orang = $this->model_mahasiswa->ambil_mahasiswa();
    $cek = $this->model_pendaftaran->cek_password($orang->id_user, $this->input->post('password'));
    if (count($cek) !== 1) {
      $data['inputerror'][] = 'password';
      $data['error_string'][] = 'Password tidak sama';
      $data['status'] = FALSE;
    }

    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }
  }
}
