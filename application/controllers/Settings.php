<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->model('m_unit'); // Tambahkan baris ini
	}

    public function view_super_admin()
	{
		$this->load->view('super_admin/settings');
    }
    
	public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
			
			$data['pegawai'] = $this->m_user->get_all_pegawai()->result_array();
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['unit'] = $this->m_unit->get_all_unit()->result_array();
			$this->load->view('admin/pegawai', $data);

		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}
	
	public function view_pegawai()
	{
		$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
		$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
		$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
		$this->load->view('pegawai/settings', $data);
	}
	public function view_kains()
	{
		$data['kains'] = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->row_array();
		$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
		$data['kains_data'] = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->result_array();
		$this->load->view('kains/settings', $data);
	}
	
	public function lengkapi_data()
	{
		// Cek session dan level user (1=pegawai, 2=admin, 3=super_admin, 4=kains)
		if ($this->session->userdata('logged_in') == true) {
			
			$id = $this->input->post('id');
			$user_level = $this->session->userdata('id_user_level');
			
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
				'email' => $this->input->post('email')
			);

			$result = $this->m_user->update_pegawai($id, $data);
			
			if($result) {
				$this->session->set_flashdata('edit', 'Data berhasil diupdate');
			}

			// Redirect berdasarkan level user
			switch($user_level) {
				case 1:
					redirect('Settings/view_pegawai');
					break;
				case 2: 
					redirect('Settings/view_admin');
					break;
				case 3:
					redirect('Settings/view_super_admin');
					break;
				case 4:
					redirect('Settings/view_kains');
					break;
				default:
					$this->session->set_flashdata('loggin_err','loggin_err');
					redirect('Login/index');
			}
			
		} else {
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Login/index');
		}
	}

	public function settings_account_super_admin()
	{
		$id = $this->session->userdata('id_user');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		// echo var_dump($id);
		// echo var_dump($username);
		// echo var_dump($password);
		// echo var_dump($re_password);
		// die();

		if($password == $re_password)
        {
            $hasil = $this->m_user->update_user($id, $username, $password);

            if($hasil==false){
                $this->session->set_flashdata('eror_edit','eror_edit');
                redirect('Settings/view_super_admin');
			}else{
				$this->session->set_flashdata('edit','edit');
				redirect('Settings/view_super_admin');
			}
			
        }else{
            $this->session->set_flashdata('password_err','password_err');
			redirect('Settings/view_super_admin');
        }
	}

	public function settings_account_admin()
	{
		$id = $this->session->userdata('id_user');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		// echo var_dump($id);
		// echo var_dump($username);
		// echo var_dump($password);
		// echo var_dump($re_password);
		// die();

		if($password == $re_password)
        {
            $hasil = $this->m_user->update_user($id, $username, $password);

            if($hasil==false){
                $this->session->set_flashdata('eror_edit','eror_edit');
                redirect('Settings/view_admin');
			}else{
				$this->session->set_flashdata('edit','edit');
				redirect('Settings/view_admin');
			}
			
        }else{
            $this->session->set_flashdata('password_err','password_err');
			redirect('Settings/view_admin');
        }
	}

	public function settings_account_pegawai()
	{
		$id = $this->session->userdata('id_user');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$re_password = $this->input->post("re_password");

		// echo var_dump($id);
		// echo var_dump($username);
		// echo var_dump($password);
		// echo var_dump($re_password);
		// die();

		if($password == $re_password)
        {
            $hasil = $this->m_user->update_user($id, $username, $password);

            if($hasil==false){
                $this->session->set_flashdata('eror_edit','eror_edit');
                redirect('Settings/view_pegawai');
			}else{
				$this->session->set_flashdata('edit','edit');
				redirect('Settings/view_pegawai');
			}
			
        }else{
            $this->session->set_flashdata('password_err','password_err');
			redirect('Settings/view_pegawai');
        }
	}
    
	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$this->load->model('User_model');
		$data['pegawai_data'] = $this->User_model->get_user_detail($id_user);
		// ... kode lainnya ...
		$this->load->view('pegawai/components/navbar', $data);
	}
}
