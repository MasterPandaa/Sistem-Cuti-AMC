<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->helper(array('form', 'url'));
    }

    public function view_pegawai() {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 1) {
            $data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
            $data['uploaded_files'] = $this->session->userdata('uploaded_files') ?? [];
            $this->load->view('pegawai/upload', $data);
        } else {
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Login/index');
        }
    }

    public function view_kains() {
        if ($this->session->userdata('logged_in') == true AND $this->session->userdata('id_user_level') == 4) {
            $data['kains'] = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->row_array();
            $data['uploaded_files'] = $this->session->userdata('uploaded_files') ?? [];
            $this->load->view('kains/upload', $data);
        } else {
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Login/index');
        }
    }

    public function do_upload() {
        if ($this->session->userdata('logged_in') == true AND 
           ($this->session->userdata('id_user_level') == 1 || $this->session->userdata('id_user_level') == 4)) {
            
            if($this->session->userdata('id_user_level') == 1) {
                $user = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
            } else {
                $user = $this->m_user->get_kains_by_id($this->session->userdata('id_user'))->row_array();
            }
            
            $nik = $user['nik'];
            
            $upload_path = './uploads/' . $nik . '/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 500;

            $this->load->library('upload', $config);

            $upload_errors = array();
            $upload_success = true;
            $uploaded_files = $this->session->userdata('uploaded_files') ?? [];

            $files = array('ktp', 'kk', 'str', 'ijazah', 'sertifikat');

            foreach ($files as $file) {
                if (!empty($_FILES[$file]['name'])) {
                    $new_name = $file . '.pdf';
                    $_FILES[$file]['name'] = $new_name;
                    
                    if (!$this->upload->do_upload($file)) {
                        $upload_errors[$file] = $this->upload->display_errors('', '');
                        $upload_success = false;
                    } else {
                        $upload_data = $this->upload->data();
                        $uploaded_files[$file] = $new_name;
                    }
                }
            }

            $this->session->set_userdata('uploaded_files', $uploaded_files);

            if ($upload_success) {
                $this->session->set_flashdata('upload_success', 'Semua file berhasil diupload');
            } else {
                $this->session->set_flashdata('upload_errors', $upload_errors);
            }

            if($this->session->userdata('id_user_level') == 1) {
                redirect('Upload/view_pegawai');
            } else {
                redirect('Upload/view_kains');
            }
        } else {
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Login/index');
        }
    }
}
