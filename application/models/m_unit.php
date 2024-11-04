<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_unit extends CI_Model {

    public function get_all_unit()
    {
        $hasil = $this->db->query('SELECT * FROM unit');
        return $hasil;
    }
}