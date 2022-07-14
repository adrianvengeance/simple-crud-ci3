<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$sesi_login = $this->session->userdata('loginMasuk');
		$level_pengguna = $this->session->userdata('level_pengguna');
		if ($sesi_login == false || $level_pengguna !== 'Admin') {
			redirect('login');
		}
	}

	public function index()
	{
		$data['judul'] = 'Fakultas';
		$data['header'] = 'admin/layout/header';
		$data['footer'] = 'admin/layout/footer';
		$data['isi'] = 'admin/isi/fakultas';
		$this->load->view('admin/layout/layout', $data);
	}

	public function ajax_list()
	{
		$list = $this->model_fakultas->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$nomor = 1;
		foreach ($list as $fakul) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $fakul->nama_fakultas;
			$row[] = $fakul->status_fakultas;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_fakultas(' . "'" . $fakul->id_fakultas . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_fakultas(' . "'" . $fakul->id_fakultas . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_fakultas->count_all(),
			"recordsFiltered" => $this->model_fakultas->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id_fakultas)
	{
		$data = $this->model_fakultas->get_by_id($id_fakultas);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'nama_fakultas' => $this->input->post('nama_fakultas'),
			'status_fakultas' => $this->input->post('status_fakultas')
		);
		$this->db->insert('fakultas', $data);
		//	$insert = $this->model_fakultas->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'nama_fakultas' => $this->input->post('nama_fakultas'),
			'status_fakultas' => $this->input->post('status_fakultas')
		);

		$this->db->where('id_fakultas', $this->input->post('id_fakultas'));
		$this->db->update('fakultas', $data);
		//	$this->model_fakultas->update(array('id_fakultas' => $this->input->post('id_fakultas')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id_fakultas)
	{

		$this->db->where('id_fakultas', $id_fakultas);
		$this->db->delete('fakultas');
		//$this->model_fakultas->delete_by_id($id_fakultas);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_fakultas') == '') {
			$data['inputerror'][] = 'nama_fakultas';
			$data['error_string'][] = 'Nama fakultas tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if ($this->input->post('status_fakultas') == '') {
			$data['inputerror'][] = 'status_fakultas';
			$data['error_string'][] = 'Status fakultas harus dipilih';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
