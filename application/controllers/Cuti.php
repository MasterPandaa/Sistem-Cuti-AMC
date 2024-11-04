<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_cuti');
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
	}
	

    public function view_super_admin()	
	{
	if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {

		$data['cuti'] = $this->m_cuti->get_all_cuti()->result_array();
		$this->load->view('super_admin/cuti', $data);

	}else{

		$this->session->set_flashdata('loggin_err','loggin_err');
		redirect('Login/index');

	}
    }
    
	public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$data['admin'] = $this->m_user->get_admin_by_id($this->session->userdata('id_user'))->row_array();
			$data['admin_data'] = $this->m_user->get_admin_by_id($this->session->userdata('id_user'))->result_array();
			$data['cuti'] = $this->m_cuti->get_all_cuti()->result_array();
			
			$this->load->view('admin/cuti', $data);
		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}
	
	public function view_pegawai($id_user)
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {

		$data['cuti'] = $this->m_cuti->get_all_cuti_by_id_user($id_user)->result_array();
		$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
		$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
		$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
		$this->load->view('pegawai/cuti', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');

		}
	}
	public function view_kains($id_user)
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {

		$data['cuti'] = $this->m_cuti->get_all_cuti_by_id_user($id_user)->result_array();
		$data['kains'] = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->row_array();
		$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
		$data['kains_data'] = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->result_array();
		$this->load->view('kains/cuti', $data);

		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');

		}
	}
	
	public function hapus_cuti()
	{

		$id_cuti = $this->input->post("id_cuti");
		$id_user = $this->input->post("id_user");

		$hasil = $this->m_cuti->delete_cuti($id_cuti);
		
		if($hasil==false){
			$this->session->set_flashdata('eror_hapus','eror_hapus');
		}else{
			$this->session->set_flashdata('hapus','hapus');
		}

		redirect('Cuti/view_pegawai/'.$id_user);
	}

	public function hapus_cuti_admin()
	{

		$id_cuti = $this->input->post("id_cuti");
		$id_user = $this->input->post("id_user");

		$hasil = $this->m_cuti->delete_cuti($id_cuti);
		
		if($hasil==false){
			$this->session->set_flashdata('eror_hapus','eror_hapus');
		}else{
			$this->session->set_flashdata('hapus','hapus');
		}

		redirect('Cuti/view_admin');
	}

	public function edit_cuti_admin()
	{
		$id_cuti = $this->input->post("id_cuti");
		$alasan = $this->input->post("alasan");
		$perihal_cuti = $this->input->post("perihal_cuti");
		$tgl_diajukan = $this->input->post("tgl_diajukan");
		$mulai = $this->input->post("mulai");
		$berakhir = $this->input->post("berakhir");


		$hasil = $this->m_cuti->update_cuti($alasan, $perihal_cuti, $tgl_diajukan, $mulai, $berakhir, $id_cuti);
		
		if($hasil==false){
			$this->session->set_flashdata('eror_edit','eror_edit');
		}else{
			$this->session->set_flashdata('edit','edit');
		}

		redirect('Cuti/view_admin');
	}

	public function acc_cuti_admin($id_status_cuti)
	{

		$id_cuti = $this->input->post("id_cuti");
		$id_user = $this->input->post("id_user");
		$alasan_verifikasi = $this->input->post("alasan_verifikasi");

		$hasil = $this->m_cuti->confirm_cuti($id_cuti, $id_status_cuti, $alasan_verifikasi);
		
		if($hasil==false){
			$this->session->set_flashdata('eror_input','eror_input');
		}else{
			$this->session->set_flashdata('input','input');
		}

		redirect('Cuti/view_admin/'.$id_user);
	}

	public function acc_cuti_super_admin($id_status_cuti)
	{

		$id_cuti = $this->input->post("id_cuti");
		$id_user = $this->input->post("id_user");
		$alasan_verifikasi = $this->input->post("alasan_verifikasi");

		$hasil = $this->m_cuti->confirm_cuti($id_cuti, $id_status_cuti, $alasan_verifikasi);
		
		if($hasil==false){
			$this->session->set_flashdata('eror_input','eror_input');
		}else{
			$this->session->set_flashdata('input','input');
		}

		redirect('Cuti/view_super_admin/'.$id_user);
	}
    
	public function index() {
		$data['title'] = 'Cuti';
		$id_user = $this->session->userdata('id_user');
		
		// Load model
		$this->load->model('m_cuti');
		$this->load->model('m_sisa_cuti');
		
		// Get data
		$data['cuti'] = $this->m_cuti->get_all_cuti_by_id_user($id_user)->result_array();
		$data['sisa_cuti'] = $this->m_sisa_cuti->get_sisa_cuti_by_id($id_user)->row_array();
		
		// Load view
		$this->load->view('pegawai/cuti', $data);
	}

	public function confirm_cuti() {
		$id_cuti = $this->input->post('id_cuti');
		$id_status_cuti = $this->input->post('id_status_cuti');
		$alasan_verifikasi = $this->input->post('alasan_verifikasi');
		$id_user = $this->input->post('id_user');
		
		// Jika cuti disetujui
		if($id_status_cuti == 2) {
			// Hitung jumlah hari cuti
			$mulai = new DateTime($this->input->post('mulai'));
			$berakhir = new DateTime($this->input->post('berakhir'));
			$interval = $mulai->diff($berakhir);
			$jumlah_hari = $interval->days + 1;
			
			// Update sisa cuti
			$jenis_cuti = $this->input->post('jenis_cuti');
			$this->db->query("UPDATE sisa_cuti SET $jenis_cuti = $jenis_cuti - $jumlah_hari WHERE id_user='$id_user'");
		}
		
		// Proses konfirmasi cuti
		$this->load->model('m_cuti');
		$update = $this->m_cuti->confirm_cuti($id_cuti, $id_status_cuti, $alasan_verifikasi);
		
		if($update) {
			$this->session->set_flashdata('input', 'success');
		} else {
			$this->session->set_flashdata('input', 'error');
		}
		
		redirect('cuti');
	}

	public function verifikasi_kains()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			// Ambil data KAINS
			$kains = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->row_array();
			
			// Ambil unit KAINS
			$id_unit = $kains['id_unit'];
			
			$data['kains'] = $kains;
			$data['kains_data'] = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->result_array();
			// Kirim id_unit ke get_all_cuti_pending
			$data['cuti'] = $this->m_cuti->get_all_cuti_pending($id_unit)->result_array();
			
			$this->load->view('kains/verifikasi_cuti', $data);
		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}

	public function proses_verifikasi_kains()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
			$id_cuti = $this->input->post("id_cuti");
			$id_status_cuti = $this->input->post("id_status_cuti");
			$alasan_verifikasi = $this->input->post("alasan_verifikasi");

			// Ambil data KAINS dan cuti
			$kains = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->row_array();
			$cuti = $this->m_cuti->get_all_cuti_by_id_cuti($id_cuti)->row_array();
			
			// Cek apakah unit sama
			if($kains['id_unit'] == $cuti['id_unit']) {
				$hasil = $this->m_cuti->confirm_cuti($id_cuti, $id_status_cuti, $alasan_verifikasi);
				
				if($hasil==false){
					$this->session->set_flashdata('eror_input','eror_input');
				} else {
					$this->session->set_flashdata('input','input');
				}
			} else {
				$this->session->set_flashdata('error_unit','Anda tidak memiliki akses untuk memverifikasi cuti dari unit lain');
			}
			redirect('Cuti/verifikasi_kains');
		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}
}