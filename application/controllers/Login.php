<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		$data['judul'] = 'Login';
		$this->load->view('admin/layout/login', $data);
	}

	public function login_masuk()
	{
		$data['judul'] = 'Login';
		$this->load->view('admin/layout/login', $data);
	}

	public function masuk_login()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$cek = $this->model_login->cek_data_pengguna($username, md5($password));

		if (count($cek) == 1) {
			foreach ($cek as $rows) {
				$id_user = $rows['id_user'];
				$nama_user = $rows['nama_user'];
				$level_pengguna = $rows['level_pengguna'];
			}

			$this->session->set_userdata(array(
				'loginMasuk'		=> TRUE,
				'id_user' 			=> $id_user,
				'nama_user' 		=> $nama_user,
				'level_pengguna' 	=> $level_pengguna
			));
			if ($this->session->userdata('level_pengguna') == 'Admin') {
				redirect('welcome');
			} elseif ($this->session->userdata('level_pengguna') == 'Mahasiswa') {
				redirect('mahasiswa');
			}
		} else {
			$this->session->set_flashdata('pesan', '<script>swal.fire("Gagal","Username atau password tidak ditemukan","error")</script>');
			redirect('login');
		}
	}

	public function sambutan()
	{
		$data['judul'] = 'Halaman Login';
		$data['isi'] = 'admin/isi/halaman_login';
		$data['footer'] = 'admin/layout/footer';
		$this->load->view('admin/layout/layout', $data);
	}

	function keluar()
	{
		//	$this->session->unset_userdata('loginMasuk');
		$this->session->sess_destroy();
		redirect('login');
	}
}
