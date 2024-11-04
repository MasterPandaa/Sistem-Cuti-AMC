<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kains extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_jenis_kelamin');
        $this->load->model('m_cuti');
        $this->load->model('m_unit');
    }

    public function view_admin()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $data['admin'] = $this->m_user->get_admin_by_id($this->session->userdata('id_user'))->row_array();
            $data['kains'] = $this->m_user->get_all_kains()->result_array();
            $data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
            $data['unit'] = $this->m_unit->get_all_unit()->result_array();
            
            $this->load->view('admin/kains', $data);
        } else {
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Login/index');
        }
    }

    public function tambah_kains()
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
            
            $id_user_level = 4;
            $password = "kains123";
            $id = md5($nik.$email.$password);

            $hasil = $this->m_user->insert_pegawai($id, $nik, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $id_unit, $tempat_lahir, $tanggal_lahir, $no_bpjs, $no_bpjs_tk, $alamat_ktp, $alamat_domisili, $wa_aktif, $wa_kerabat, $asal_pt, $no_ijazah, $tanggal_lulus, $profesi_str, $no_str, $tanggal_terbit_str, $masa_berlaku_str, $no_sip, $tanggal_terbit_sip, $masa_berlaku_sip, $nama_faskes_sip, $status);

            if($hasil==false){
                $this->session->set_flashdata('eror','eror');
            }else{
                $this->session->set_flashdata('input','input');
            }
            redirect('Kains/view_admin');
        } else {
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Login/index');
        }
    }

    public function edit_kains()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
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
            }else{
                $this->session->set_flashdata('edit','edit');
            }
            redirect('Kains/view_admin');
        } else {
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Login/index');
        }
    }

    public function hapus_kains()
    {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 2) {
            $id = $this->input->post('id_user');
            
            $result = $this->m_user->delete_kains($id);
            
            if($result) {
                $this->session->set_flashdata('hapus', 'success');
            } else {
                $this->session->set_flashdata('error_hapus', 'error');
            }
            redirect('Kains/view_admin');
        } else {
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Login/index');
        }
    }

    public function index()
    {
        $data['kains'] = $this->m_user->get_all_kains()->result_array();
        if(empty($data['kains'])) {
            // Log atau tampilkan pesan debug
            echo "Data KAINS tidak ditemukan";
        }
        // ... kode lainnya ...
    }
}
