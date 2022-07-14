<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $sesi_login = $this->session->userdata('loginMasuk');
    $level_pengguna = $this->session->userdata('level_pengguna');
    if ($sesi_login == false || $level_pengguna != 'Admin') {
      redirect('login');
    }
  }

  public function index()
  {
    $data['judul'] = 'Prodi';
    $data['header'] = 'admin/layout/header';
    $data['footer'] = 'admin/layout/footer';
    $data['isi'] = 'admin/isi/prodi';
    $data['fakultas'] = $this->model_prodi->ambil_fakultas();
    $this->load->view('admin/layout/layout', $data);
  }

  public function ajax_list()
  {
    $list = $this->model_prodi->get_datatables();
    $data = array();
    $no = $_POST['start'];
    $nomor = 1;
    foreach ($list as $prodi) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $prodi->nama_fakultas;
      $row[] = $prodi->nama_prodi;
      $row[] = $prodi->status_prodi;
      $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_prodi(' . "'" . $prodi->id_prodi . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_prodi(' . "'" . $prodi->id_prodi . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->model_prodi->count_all(),
      "recordsFiltered" => $this->model_prodi->count_filtered(),
      "data" => $data,
    );
    echo json_encode($output);
  }

  public function ajax_edit($id_prodi)
  {
    $data = $this->model_prodi->get_by_id($id_prodi);
    echo json_encode($data);
  }

  public function ajax_add()
  {
    $this->_validate();
    $data = array(
      'id_fakultas' => $this->input->post('id_fakultas'),
      'nama_prodi' => $this->input->post('nama_prodi'),
      'status_prodi' => $this->input->post('status_prodi')
    );
    $insert = $this->model_prodi->save($data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_update()
  {
    $this->_validate();
    $data = array(
      'id_fakultas' => $this->input->post('id_fakultas'),
      'nama_prodi' => $this->input->post('nama_prodi'),
      'status_prodi' => $this->input->post('status_prodi')
    );
    $this->model_prodi->update(array('id_prodi' => $this->input->post('id_prodi')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_delete($id_prodi)
  {
    $this->db->where('id_prodi', $id_prodi);
    $this->db->delete('prodi');
    echo json_encode(array("status" => TRUE));
  }

  private function _validate()
  {
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if ($this->input->post('id_fakultas') == '') {
      $data['inputerror'][] = 'id_fakultas';
      $data['error_string'][] = 'Fakultas harus dipilih';
      $data['status'] = FALSE;
    }

    if ($this->input->post('nama_prodi') == '') {
      $data['inputerror'][] = 'nama_prodi';
      $data['error_string'][] = 'Nama prodi tidak boleh kosong';
      $data['status'] = FALSE;
    }

    if ($this->input->post('status_prodi') == '') {
      $data['inputerror'][] = 'status_prodi';
      $data['error_string'][] = 'Status prodi harus dipilih';
      $data['status'] = FALSE;
    }

    if ($data['status'] === FALSE) {
      echo json_encode($data);
      exit();
    }
  }
}
