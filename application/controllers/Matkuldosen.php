<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matkuldosen extends CI_Controller { 

  public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}else if (!$this->ion_auth->is_admin()){
			show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="'.base_url('dashboard').'">Kembali ke menu awal</a>', 403, 'Akses Terlarang');			
		}
		$this->load->library(['datatables', 'form_validation']);// Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->form_validation->set_error_delimiters('','');
	}


  public function index() {

    $data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Matkul Dosen',
			'subjudul'=> 'Data Kelas Dosen'
		];
		
    $data['matkul_dosen'] = $this->master->getMatkuldosen();
    $this->load->view('_templates/dashboard/_header.php', $data);
    $this->load->view('relasi/matkuldosen/data', $data);
		$this->load->view('_templates/dashboard/_footer.php');

  }



}