<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->model('m_unit');
	}

    public function view_super_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
			$data['pegawai'] = $this->m_user->get_all_pegawai_detail()->result_array();
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['unit'] = $this->m_unit->get_all_unit();
			$this->load->view('super_admin/pegawai', $data);
		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}
    
	public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$data['admin'] = $this->m_user->get_admin_by_id($this->session->userdata('id_user'))->row_array();
			$data['admin_data'] = $this->m_user->get_admin_by_id($this->session->userdata('id_user'))->result_array();
			$data['pegawai'] = $this->m_user->get_all_pegawai()->result_array();
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['unit'] = $this->m_unit->get_all_unit()->result_array();
			
			$this->load->view('admin/pegawai', $data);
		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}

	public function tambah_pegawai()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_unit = $this->input->post("id_unit");
			$tempat_lahir = $this->input->post("tempat_lahir");
			$tanggal_lahir = $this->input->post("tanggal_lahir");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$nik = $this->input->post("nik");
			$no_bpjs = $this->input->post("no_bpjs");
			$no_bpjs_tk = $this->input->post("no_bpjs_tk");
			$alamat_ktp = $this->input->post("alamat_ktp");
			$alamat_domisili = $this->input->post("alamat_domisili");
			$wa_aktif = $this->input->post("wa_aktif");
			$wa_kerabat = $this->input->post("wa_kerabat");
			$email = $this->input->post("email");
			$asal_pt = $this->input->post("asal_pt");
			$no_ijazah = $this->input->post("no_ijazah");
			$tanggal_lulus = $this->input->post("tanggal_lulus");
			$profesi_str = $this->input->post("profesi_str");
			$no_str = $this->input->post("no_str");
			$tanggal_terbit_str = $this->input->post("tanggal_terbit_str");
			$masa_berlaku_str = $this->input->post("masa_berlaku_str");
			$no_sip = $this->input->post("no_sip");
			$tanggal_terbit_sip = $this->input->post("tanggal_terbit_sip");
			$masa_berlaku_sip = $this->input->post("masa_berlaku_sip");
			$nama_faskes_sip = $this->input->post("nama_faskes_sip");
			$status = $this->input->post("status");
			
			$id_user_level = 1;
			$password = "amc123";
			$id = md5($nik.$email.$password);

			$hasil = $this->m_user->insert_pegawai($id, $nik, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $id_unit, $tempat_lahir, $tanggal_lahir, $no_bpjs, $no_bpjs_tk, $alamat_ktp, $alamat_domisili, $wa_aktif, $wa_kerabat, $asal_pt, $no_ijazah, $tanggal_lulus, $profesi_str, $no_str, $tanggal_terbit_str, $masa_berlaku_str, $no_sip, $tanggal_terbit_sip, $masa_berlaku_sip, $nama_faskes_sip, $status);

			if($hasil==false){
				$this->session->set_flashdata('eror','eror');
				redirect('Pegawai/view_admin');
			}else{
				$this->session->set_flashdata('input','input');
				redirect('Pegawai/view_admin');
			}
		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}

	public function edit_pegawai()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			$id = $this->input->post('id_user');
			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'id_unit' => $this->input->post('id_unit'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'id_jenis_kelamin' => $this->input->post('id_jenis_kelamin'),
				'nik' => $this->input->post('nik'),
				'no_bpjs' => $this->input->post('no_bpjs'),
				'no_bpjs_tk' => $this->input->post('no_bpjs_tk'),
				'alamat_ktp' => $this->input->post('alamat_ktp'),
				'alamat_domisili' => $this->input->post('alamat_domisili'),
				'wa_aktif' => $this->input->post('wa_aktif'),
				'wa_kerabat' => $this->input->post('wa_kerabat'),
				'email' => $this->input->post('email'),
				'asal_pt' => $this->input->post('asal_pt'),
				'no_ijazah' => $this->input->post('no_ijazah'),
				'tanggal_lulus' => $this->input->post('tanggal_lulus'),
				'profesi_str' => $this->input->post('profesi_str'),
				'no_str' => $this->input->post('no_str'),
				'tanggal_terbit_str' => $this->input->post('tanggal_terbit_str'),
				'masa_berlaku_str' => $this->input->post('masa_berlaku_str'),
				'no_sip' => $this->input->post('no_sip'),
				'tanggal_terbit_sip' => $this->input->post('tanggal_terbit_sip'),
				'masa_berlaku_sip' => $this->input->post('masa_berlaku_sip'),
				'nama_faskes_sip' => $this->input->post('nama_faskes_sip'),
				'status' => $this->input->post('status')
			);

			$result = $this->m_user->update_pegawai($id, $data);
			if ($result) {
				$this->session->set_flashdata('edit', 'Data berhasil diupdate');
			} else {
				$this->session->set_flashdata('eror_edit', 'Gagal mengupdate data');
			}

			redirect('pegawai/view_admin');
		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}

	public function hapus_pegawai()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
		
        	$id = $this->input->post("id_user");

        
            $hasil = $this->m_user->delete_pegawai($id);

            if($hasil==false){
                $this->session->set_flashdata('eror_hapus','eror_hapus');
                redirect('Pegawai/view_admin');
			}else{
				$this->session->set_flashdata('hapus','hapus');
				redirect('Pegawai/view_admin');
			}
			
		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}

	public function super_admin_tambah_pegawai()
	{
	if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
		$username = $this->input->post("username");
        $password = $this->input->post("password");
		$email = $this->input->post("email");
		$nama_lengkap = $this->input->post("nama_lengkap");
		$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
		$id_user_level = 1;
        $id = md5($username.$email.$password);

        
            $hasil = $this->m_user->insert_pegawai($id, $username, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin);

            if($hasil==false){
                $this->session->set_flashdata('eror','eror');
                redirect('Pegawai/view_super_admin');
			}else{
				$this->session->set_flashdata('input','input');
				redirect('Pegawai/view_super_admin');
            }
		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
     
	}

	public function super_admin_edit_pegawai()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {

		$id = $this->input->post("id_user");
        $data = array(
            'nama_lengkap' => $this->input->post("nama_lengkap"),
            'id_unit' => $this->input->post("id_unit"),
            'tempat_lahir' => $this->input->post("tempat_lahir"),
            'tanggal_lahir' => $this->input->post("tanggal_lahir"),
            'id_jenis_kelamin' => $this->input->post("id_jenis_kelamin"),
            'nik' => $this->input->post("nik"),
            'no_bpjs' => $this->input->post("no_bpjs"),
            'no_bpjs_tk' => $this->input->post("no_bpjs_tk"),
            'alamat_ktp' => $this->input->post("alamat_ktp"),
            'alamat_domisili' => $this->input->post("alamat_domisili"),
            'wa_aktif' => $this->input->post("wa_aktif"),
            'wa_kerabat' => $this->input->post("wa_kerabat"),
            'email' => $this->input->post("email"),
            'asal_pt' => $this->input->post("asal_pt"),
            'no_ijazah' => $this->input->post("no_ijazah"),
            'tanggal_lulus' => $this->input->post("tanggal_lulus"),
            'profesi_str' => $this->input->post("profesi_str"),
            'no_str' => $this->input->post("no_str"),
            'tanggal_terbit_str' => $this->input->post("tanggal_terbit_str"),
            'masa_berlaku_str' => $this->input->post("masa_berlaku_str"),
            'no_sip' => $this->input->post("no_sip"),
            'tanggal_terbit_sip' => $this->input->post("tanggal_terbit_sip"),
            'masa_berlaku_sip' => $this->input->post("masa_berlaku_sip"),
            'nama_faskes_sip' => $this->input->post("nama_faskes_sip"),
            'status' => $this->input->post("status")
        );
        
        $hasil = $this->m_user->update_pegawai($id, $data);

        if($hasil==false){
            $this->session->set_flashdata('eror_edit','eror_edit');
            redirect('Pegawai/view_super_admin');
        }else{
            $this->session->set_flashdata('edit','edit');
            redirect('Pegawai/view_super_admin');
        }
		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}

	public function super_admin_hapus_pegawai()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 3) {
		
        	$id = $this->input->post("id_user");

        
            $hasil = $this->m_user->delete_pegawai($id);

            if($hasil==false){
                $this->session->set_flashdata('eror_hapus','eror_hapus');
                redirect('Pegawai/view_super_admin');
			}else{
				$this->session->set_flashdata('hapus','hapus');
				redirect('Pegawai/view_super_admin');
			}
			
			
		}else{

			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
	
		}
	}
	
    
}